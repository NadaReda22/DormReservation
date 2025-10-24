<?php

namespace App\Jobs;

use Exception;
use Throwable;
use App\Models\Room;
use App\Models\Student;
use App\Mail\RoomSelectionMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ConfirmStudentReservationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $studentRoomId;

    /**
     * Create a new job instance.
     */
    public function __construct($studentRoom)
    {
        $this->studentRoomId = $studentRoom->id;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $studentRoom = DB::table('student_room')->find($this->studentRoomId);

        if (!$studentRoom || $studentRoom->status !== 'pending') {
            return;
        }

        $room = Room::where('id',$studentRoom->room_id)->lockForUpdate()->first();
        if (!$room) {
            return;
        }

        $student = Student::find($studentRoom->student_id);
        if (!$student) {
            return;
        }

        $hasPaid = $this->checkPayment($studentRoom);
        $room->refresh();

        if ($hasPaid) {
            // ✅ Payment succeeded → confirm student and update room
            DB::transaction(function () use ($studentRoom, $student, $room) {

                // Update this student's room record
                DB::table('student_room')
                    ->where('id', $studentRoom->id)
                    ->update([
                        'status'       => 'confirmed',
                        'confirmed_at' => now(),
                        'updated_at'   => now(),
                    ]);

                // Update room counters
                $room->increment('confirmed_count');
                $room->decrement('pending_count');
                $room->refresh();

                // Mark student as confirmed
                DB::table('students')
                    ->where('id', $student->id)
                    ->update([
                        'confirmed' => 1,
                        'room_id'   => $studentRoom->room_id,
                        'updated_at' => now(),
                    ]);

                    // dd($student->id);

                Mail::to($student->email) ->queue( new RoomSelectionMail($student,$room));


                // ✅ If room full, mark as confirmed and remove other pending students
                if ($room->confirmed_count >= $room->capacity) {
                    $room->update([
                        'status' => 'confirmed',
                        'pending_count' => 0,
                    ]);

                    // Remove all pending students from this room
                    DB::table('student_room')
                        ->where('room_id', $room->id)
                        ->where('status', 'pending')
                        ->update(['status' => 'removed']);

                    // 🧹 Delete queued jobs for this confirmed (now full) room
                    DB::table('jobs')->where('payload', 'like', '%"room_id":' . $room->id . '%')->delete();
                } else {
                    $room->update(['status' => 'pending']);
                }

                // ✅ Remove this student's other room priorities + delete their queued jobs
                foreach ($student->rooms as $r) {
                    if ($r->id != $studentRoom->room_id) {
                        // Mark other priorities as removed
                        DB::table('student_room')
                            ->where('student_id', $student->id)
                            ->where('room_id', $r->id)
                            ->update(['status' => 'removed']);

                        // Delete queued jobs related to these other room priorities
                        DB::table('jobs')
                            ->where('payload', 'like', '%"studentRoomId":' . $r->pivot->id . '%')
                            ->orWhere('payload', 'like', '%"room_id":' . $r->id . '%')
                            ->delete();
                    }
                }
            });

        } else {
            // ❌ Payment failed → remove this student's reservation
            DB::table('student_room')
                ->where('id', $studentRoom->id)
                ->update(['status' => 'removed', 'updated_at' => now()]);

            // Find next pending student for the same room
            $next = DB::table('student_room')
                ->where('room_id', $studentRoom->room_id)
                ->where('status', 'pending')
                ->orderBy('reserved_at')
                ->first();

            if ($next) {
                // Dispatch next job after 1 minutes
                DB::table('student_room')
                    ->where('id', $next->id)
                    ->update([
                        'reserved_at' => now(),
                        'updated_at'  => now(),
                    ]);

                ConfirmStudentReservationJob::dispatch((object)['id' => $next->id])
                    ->delay(now()->addMinutes(30));
            }
        }
    }

    /**
     * Mock payment check (replace with actual gateway logic)
     */
    private function checkPayment($studentRoom)
    {
        // Simulate a real payment check
        return true; // Payment succeeded (for testing)
    }


    public function failed(Throwable $exception)
    {
      DB::transaction(function(){
        
        $studentRoom=DB::table('student_room')->find($this->studentRoomId);

         if ($studentRoom && $studentRoom->status === 'pending') {
            // Remove the pending record
            DB::table('student_room')->where('id', $studentRoom->id)->delete();

            // Decrement pending count for that room
            $room = Room::find($studentRoom->room_id);
            if ($room) {
                $room->decrement('pending_count');
                $room->updateStatus();
            }
        }
      });
    }
}
