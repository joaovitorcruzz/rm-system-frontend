<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware('auth')->group(function () {

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/room/{id}', [RoomController::class, 'index'])->name('view-room');
Route::post('/rooms/filter', [HomeController::class, 'filter'])->name('rooms.filter');
Route::get('/rooms/reserve/{room_id}/{user_id}', [RoomController::class, 'reserve'])->name('reserve-room');
Route::get('/rooms/disreserve/{id}', [RoomController::class, 'disreserve'])->name('disreserve-room');


Route::get('/task/reserve/{room_id}/{schedule_id}/{user_id}', [RoomController::class, 'reservetask'])->name('reserve-task');
Route::get('/taks/disreserve/{id}', [RoomController::class, 'disreservetask'])->name('disreserve-task');
});