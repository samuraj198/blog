<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\IndexController;
use \App\Http\Controllers\PostsController;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/profile', [IndexController::class, 'profile'])->name('profile');

Route::get('/auth', function () {
    return view('pages/auth');
})->name('auth');

Route::post('/auth', [AuthController::class, 'store']);

Route::delete('/auth', [AuthController::class, 'destroy']);

Route::get('/register', function () {
    return view('pages/register');
})->name('register');

Route::post('/register', [RegisterController::class, 'store']);

Route::post('/createPost', [PostsController::class, 'store'])->name('createPost');
