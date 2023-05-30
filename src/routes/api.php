<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\EscapeRoomController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/escape-rooms', [EscapeRoomController::class, 'index']);
Route::get('/escape-rooms/{escapeRoom}', [EscapeRoomController::class, 'show']);
Route::get('/escape-rooms/{escapeRoom}/time-slots', [EscapeRoomController::class, 'timeSlots']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::get('/bookings', [BookingController::class, 'index']);
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy']);
});

