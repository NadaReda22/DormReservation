<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;


class Student extends Authenticatable 
{

    use HasFactory,Notifiable;
    protected $guarded=['verified','room_id'];
    
//   protected $fillable = ['email', 'student_id', 'password'];
    protected $hidden = ['password'];


   /**
   * 
   * Auto Generate Student Id
   * 
   */   

protected static function booted()
{
    static::creating(function ($student)
    {
   $year=now()->year; 
   $latestId=Student::max('id');
   $student->student_id='STD'.'-'.$year.'-'.str_pad($latestId,4,'0',STR_PAD_LEFT);
    });
}


/**
 * 
 * Relationship
 */

public function rooms()
{
    return $this->belongsToMany(Room::class,'student_room')
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
}