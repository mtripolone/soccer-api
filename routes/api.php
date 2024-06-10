<?php

use App\Http\Controllers\PlayerController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\TeamController;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

//Route::middleware('auth:sanctum')->group(function () {
    Route::get('/players', [PlayerController::class, 'index']);
    Route::post('/players', [PlayerController::class, 'store']);
    Route::get('/players/{id}', [PlayerController::class, 'show']);
    Route::put('/players/{id}', [PlayerController::class, 'update']);
    Route::delete('/players/{id}', [PlayerController::class, 'destroy']);

    Route::get('/attendances', [AttendanceController::class, 'index']);
    Route::post('/attendances', [AttendanceController::class, 'store']);
    Route::get('/attendances/{id}', [AttendanceController::class, 'show']);
    Route::put('/attendances/{id}', [AttendanceController::class, 'update']);
    Route::delete('/attendances/{id}', [AttendanceController::class, 'destroy']);

    Route::post('/matches', [GameController::class, 'store']);

    Route::get('/team', [TeamController::class, 'index']);
    Route::get('/team/{id}', [TeamController::class, 'show']);
//});

Route::middleware('guest')->group(function () {
    Route::post('/register', 'App\Http\Controllers\Auth\RegisteredUserController@store');
    Route::post('/login', 'App\Http\Controllers\Auth\AuthenticatedSessionController@store');
});

Route::middleware('auth:sanctum')->post('/logout', 'App\Http\Controllers\Auth\AuthenticatedSessionController@destroy');



