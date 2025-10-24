<?php

namespace App\Models;

use Database\Factories\RoomFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Room extends Model
{

  use HasFactory;
  protected $guarded= [];


 
  /**
   * 
   * Auto Generate Room Code
   * 
   */

  protected static function booted()
  {
    static::creating(function($room)
    {
             $lastRoom = Room::latest('id')->first(); // get last inserted record

        if(!$lastRoom) {
            $id = 1;
            $floor = 'A';
        } else {
            $lastCode = $lastRoom->room_id; // e.g., "A1", "A12", "B5"
            $floor = substr($lastCode, 0, 1); // letter part
            $id = intval(substr($lastCode, 1)); // number part

            if ($id < 12) {
                $id++;
            } else {
                $floor = chr(ord($floor) + 1); // move to next letter
                $id = 1;
            }
        }

        $room->room_id = $floor . $id; // assign new room_id
    });
   
  }


 /**
  * 
  * Relationships
  *
  */

   public function students()
   {
    return $this->belongsToMany(Student::class,'student_room')
    ->withPivot('status','priority','payment_type')
    ->withTimestamps();
   }
  
    
    public function confirmed()
    {
        return $this->rooms()
        ->wherePivot('status','confirmed');
    }

    public function pending()
    {
        return $this->rooms()
        ->wherePivot('status','pending');
    }

    public function updateStatus(){

$this->refresh();
    if ($this->confirmed_count >= $this->capacity) {
        $this->status = 'confirmed';
    } elseif ($this->pending_count + $this->confirmed_count >= $this->capacity) {
        $this->status = 'pending';
    } else {
        $this->status = 'empty';
    }

    $this->save();
    }
}
