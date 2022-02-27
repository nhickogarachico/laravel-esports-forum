<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});


Route::prefix('register')->controller(RegisterController::class)->group(function() {
    Route::get('/', 'showRegisterView');
    Route::post('/', 'registerUser');
});

Route::get('/login', [AuthController::class, 'showLoginView']);
Route::post('/login', [AuthController::class, 'loginUser']);
