<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\IndexController;
use \App\Http\Controllers\PostsController;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [IndexController::class, 'profile'])->name('profile');
    Route::delete('/auth', [AuthController::class, 'destroy']);
    Route::post('/createPost', [PostsController::class, 'store'])->name('createPost');
    Route::post('/addToArchive', [PostsController::class, 'addToArchive'])->name('addToArchive');
    Route::delete('/deletePost', [PostsController::class, 'destroy'])->name('deletePost');
    Route::post('/approveComment', [PostsController::class, 'approveComment'])->name('approveComment');
});

Route::get('/auth', function () {
    return view('pages/auth');
})->name('login');

Route::post('/auth', [AuthController::class, 'store']);

Route::get('/register', function () {
    return view('pages/register');
})->name('register');

Route::post('/register', [RegisterController::class, 'store']);

Route::get('/post/{id}', [PostsController::class, 'showPost'])->name('showPost');

Route::post('/createComment/{id}', [PostsController::class, 'createComment'])->name('createComment');
