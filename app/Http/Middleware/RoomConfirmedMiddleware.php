<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoomConfirmedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

          $user = Auth::user();     $rooms=$user->rooms;

     $hasConfirmed=Student::where('id',$user->id)
     ->where('confirmed',1)
     ->exists();


        if($hasConfirmed || $rooms->isNotEmpty())
       return redirect()->route('selection.success')->with('error','You already has cofirmed room !');   

        return $next($request);
    }
}
