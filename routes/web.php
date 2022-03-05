<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Like\LikeController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Search\SearchController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;



Route::prefix('register')->controller(RegisterController::class)->group(function() {
    Route::get('/', 'showRegisterView')->name('register');
    Route::post('/', 'registerUser');
});

Route::get('/login', [AuthController::class, 'showLoginView'])->name('login');
Route::post('/login', [AuthController::class, 'loginUser']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/u/{username}', [ProfileController::class, 'showProfileView'])->name("user-profile");
Route::get('/u/{username}/edit', [ProfileController::class, 'showEditProfileView'])->middleware('auth');
Route::put('/u/{username}/edit', [ProfileController::class, 'editUserProfile'])->middleware('auth');

Route::get('/u/{username}/p/new', [PostController::class, 'showNewPostView']);
Route::post('/u/{username}/p/new', [PostController::class, 'addPost']);
Route::get('/u/{username}/p', [PostController::class, 'showUserPostsView']);

Route::get('/p/{postSlug}', [PostController::class, 'showPostPageView']);
Route::get('/p/{postSlug}/edit', [PostController::class, 'showEditPostView'])->middleware('auth');
Route::put('/p/{postSlug}/edit', [PostController::class, 'editPost']);
Route::delete('/p/{postSlug}/delete', [PostController::class, 'deletePost']);

Route::get('/p/{postSlug}/like', [LikeController::class, 'getPostLikeData']);
Route::get('/c/{commentId}/like', [LikeController::class, 'getCommentLikeData']);
Route::post('/p/{postSlug}/like', [LikeController::class, 'likePost'])->middleware('auth');
Route::delete('/p/{postSlug}/like', [LikeController::class, 'unlikePost'])->middleware('auth');
Route::post('/c/{commentId}/like', [LikeController::class, 'likeComment'])->middleware('auth');
Route::delete('/c/{commentId}/like', [LikeController::class, 'unlikeComment'])->middleware('auth');

Route::get('/search', [SearchController::class, 'showSearchResults']);

Route::get('/admin', [AdminController::class, 'showAdminHomeView']);
Route::get('/admin/users', [AdminController::class, 'showAdminUserView']);
Route::get('/admin/tags', [AdminController::class, 'showAdminTagsView']);
Route::post('/admin/tags', [AdminController::class, 'addTag']);
Route::get('/admin/posts', [AdminController::class, 'showAdminPostsView']);

Route::post('p/{postSlug}/comment/{commentId?}', [CommentController::class, 'comment'])->middleware('auth');
Route::get('c/{commentId}/reply', [CommentController::class, 'showCommentReplyView'])->middleware('auth');
Route::post('p/{postSlug}/comment', [CommentController::class, 'comment'])->middleware('auth');

Route::get('/{tag?}', [HomeController::class, 'showHomeView'] );

