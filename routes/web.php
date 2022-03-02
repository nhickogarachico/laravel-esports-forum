<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});


Route::prefix('register')->controller(RegisterController::class)->group(function() {
    Route::get('/', 'showRegisterView')->name('register');
    Route::post('/', 'registerUser');
});

Route::get('/login', [AuthController::class, 'showLoginView'])->name('login');
Route::post('/login', [AuthController::class, 'loginUser']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/u/{username}', [ProfileController::class, 'showProfileView']);

Route::get('/u/{username}/p/new', [PostController::class, 'showNewPostView']);
Route::post('/u/{username}/p/new', [PostController::class, 'addPost']);
Route::get('/u/{username}/p', [PostController::class, 'showUserPostsView']);

Route::get('/p/{postSlug}', [PostController::class, 'showPostPageView']);
Route::get('/p/{postSlug}/edit', [PostController::class, 'showEditPostView'])->middleware('auth');
Route::put('/p/{postSlug}/edit', [PostController::class, 'editPost']);
