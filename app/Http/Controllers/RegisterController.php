<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Mail\RegisteredMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
   public function Show()
   {
    return view('register');
   }


   public function studentRegister(Request $request)
   {

    /**
     * Form Validation 
     */

    $validated=$request->validate([
        'name'=>'required|string|min:10',
        'phone'=>'nullable|string|min:11|max:11',
        'email'=>'required|email|unique:students,email',
        'password'=>'required|string|min:8',
        'id_image'=>'required|image|mimes:jpg,png,jpeg,pdf|max:4096',
        'verification_report'=>'required|image|mimes:jpg,png,jpeg,pdf|max:4096',
        'home_city'=>'required|string',
        'school_year'=>'required|in:1,2,3,4,5',
    ]);

    
    $validated['password']=bcrypt($validated['password']);

    $student =new Student($validated);

    if($request->hasFile('id_image'))
    {
        $file=$request->file('id_image');
        $originalName=pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
        $originalExtension=$file->getClientOriginalExtension();

        $file_name=$originalName . '_' . time() . $originalExtension ;

        $file->storeAs('uploads/ids',$file_name,'public');

        $student->id_image= 'uploads/ids/'. $file_name;

    }

      if($request->hasFile('verification_report'))
    { 
         $file=$request->file('verification_report');
        $originalName=pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
        $originalExtension=$file->getClientOriginalExtension();

        $file_name=$originalName . '_' . time() . $originalExtension ;

        $file->storeAs('uploads/ids',$file_name,'public');

        $student->id_image= 'uploads/ids/'. $file_name;
    }


    $student->save();
    Auth::login($student);

 Mail::to($request->email) ->later(now()->addMinutes(1), new RegisteredMail($student));


    return view('register_verification_notification');

   }
}
