<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
     public function Show()
   {
    return view('login');
   }


   public function studentLogin(Request $request)
   {

    /**
     * Form Validation 
     */

    $validated=$request->validate([
        'email'=>'required|email|exists:students,email',
        'password'=>'required|string|min:8',
        'student_id'=>'required|string'
    ]);

    $student=Student::where('email',$validated['email'])
    ->where('student_id',$validated['student_id'])
    ->first();

    if(!$student || !Hash::check($validated['password'],$student->password))
    {
        echo 'error';
        return back()
        ->withErrors([
            'email'=>'بيانات الدخول غير صحيحة',
        ])->withInput();

    }
    
    Auth::login($student);//add id in auth
    $request->session()->regenerate();


    return redirect()->route('rooms');

   }
}
