<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});


Route::prefix('register')->controller(RegisterController::class)->group(function() {
    Route::get('/', 'showRegisterView');
    Route::post('/', 'registerUser');
});
