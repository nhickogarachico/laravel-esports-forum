<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/register', [RegisterController::class, 'showRegisterView']);


