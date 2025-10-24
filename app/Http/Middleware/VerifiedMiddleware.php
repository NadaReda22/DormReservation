<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifiedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
            $user = Auth::user();

     $hasVerified=Student::where('id',$user->id)
     ->where('verified',1)
     ->exists();

        if(!$user || !$hasVerified)
       return redirect()->route('home')->with('error','You haven\'t been Verified yet !');   
       
        return $next($request);
    }
}
