<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\FavoriteController;

Route::get('/', function () {
    return to_route('feed');
});

// feed
Route::get('/feed', [FeedController::class, 'feed'])->name('feed');
Route::get('/search-list', [FeedController::class, 'searchList'])->name('search-list');
Route::get('/search', [FeedController::class, 'search'])->name('search');
Route::get('/search/map', [FeedController::class, 'searchMap'])->name('search-map');

// Profile
Route::get('/profile/{publisher}', [UserController::class, 'show'])->name('profile.show');
Route::get('/profile', [UserController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::put('/profile/update', [UserController::class, 'update'])->name('profile.update')->middleware('auth');

// Post
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/add-post', [PostController::class, 'create'])->name('posts.create')->middleware('auth');
Route::post('/store-post', [PostController::class, 'store'])->name('posts.store')->middleware('auth');
Route::delete('/delete-post/{post_id}', [PostController::class, 'delete'])->name('posts.delete')->middleware('auth');

// Favorite
Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index')->middleware('auth');
Route::get('/add-favorite/{user_id}/{post_id}', [FavoriteController::class, 'store'])->name('favorites.store')->middleware('auth');
Route::get('/delete-favorite/{user_id}/{post_id}', [FavoriteController::class, 'delete'])->name('favorites.delete')->middleware('auth');

// upload
Route::post('/tmp-upload', [UploadController::class, 'upload'])->name('tmp-upload');
Route::delete('/tmp-delete', [UploadController::class, 'delete'])->name('tmp-delete');

// Auth
Route::get('/register', function() { return view('auth.register'); })->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', function() { return view('auth.login'); })->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login');

Route::post('/logout', [AuthController::class, 'logoutPost'])->name('logout');