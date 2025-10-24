<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Doctrine\DBAL\Driver\Middleware;

use function Pest\Laravel\withoutMiddleware;

Route::get('/home', function () {
    return 'hello!';
})->name('home');

Route::middleware(['auth','verified','confirmed'])->group(function(){

Route::get('/get/rooms',[RoomController::class,'getAvailableRooms'])->name('rooms');
Route::post('/rooms/select',[RoomController::class,'selectRoom']);

});


Route::get('/show/register',[RegisterController::class,'show']);

Route::post('/register',[RegisterController::class,'StudentRegister']);

Route::get('/show/login',[LoginController::class,'show'])->name('login');

Route::post('/login',[LoginController::class,'studentLogin']);

//Selection Succes Notification
Route::get('success', function () {
    return view('reserved_notification');
})->name('selection.success')->middleware(['auth','verified']);
