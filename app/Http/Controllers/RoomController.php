<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Jobs\ConfirmStudentReservationJob;

class RoomController extends Controller
{
    public function getAvailableRooms()
    {
        $rooms=Room::whereIn('status',['pending','empty'])
        ->get();

         $erooms = Room::whereRaw('pending_count + confirmed_count < capacity')
        ->whereIn('status', ['pending', 'empty'])
        ->get();
        return view('rooms',compact('rooms','erooms'));
    }

    public function selectRoom(Request $request)
    {
  $validated=$request->validate(
    [
        'priority_one'=>'required|exists:rooms,id',
        'priority_two'=>'nullable|exists:rooms,id',
        'payment_type'=>'required|in:cash,visa',
    ]);
    
    $student=Auth::user();

    $student=Student::findOrFail($student->id);
     

DB::transaction(function()use ( $request, $student){

    $room=Room::find($request->priority_one);

     if($room->status != 'confirmed'){
    $studentRoom1Id=DB::table('student_room')->insertGetId(
       ['student_id'   => $student->id,
        'room_id'      => $request->priority_one,
        'status'       => 'pending',
        'priority'     => 1,
        'payment_type' => $request->payment_type,
        'reserved_at'  => now(),
        'created_at'   => now(),
        'updated_at'   => now(),
        ]);
        $studentRoom1= DB::table('student_room')->find($studentRoom1Id);

    

             // Increment pending count
            $room->increment('pending_count');
            $room->refresh();

            $room->updateStatus();
                    


     ConfirmStudentReservationJob::dispatch($studentRoom1)->delay(now()->addMinutes(30));
    }
                   // Handle optional second priority
            if ($request->filled('priority_two')) {
                 $room2 = Room::find($request->priority_two);

                 if($room2->status != 'confirmed'){
                $studentRoom2Id = DB::table('student_room')->insertGetId([
                    'student_id'   => $student->id,
                    'room_id'      => $request->priority_two,
                    'status'       => 'pending',
                    'priority'     => 2,
                    'payment_type' => $request->payment_type,
                    'reserved_at'  => now(),
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ]);

                
                $studentRoom2 = DB::table('student_room')->find($studentRoom2Id);
               

                $room2->increment('pending_count');
                $room2->refresh();
                $room2->updateStatus();


                ConfirmStudentReservationJob::dispatch($studentRoom2)
                   ->delay(now()->addMinutes(30));
            }
        }
                });
            

    return view('room_selection_notification')->with('message', 'تم تسجيل طلبك بنجاح، تابع بريدك الإلكترون');

}
}