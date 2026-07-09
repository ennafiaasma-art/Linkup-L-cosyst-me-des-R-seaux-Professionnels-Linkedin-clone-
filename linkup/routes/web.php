<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;

// affiche post

Route::get('/feed', [PostController::class, 'index'])->name('feed');

// authentification


Route::get('/register', [AuthController::class, 'showRegister'])->name('show.register');
Route::post('/register', [AuthController::class, 'Register'])->name('register');

Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');
Route::post('/login', [AuthController::class, 'Login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// publication



Route::middleware('auth')->group(function () {

    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');

    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    // likes

    Route::post('/posts/{post}/like', [LikeController::class, 'toggle'])
    ->middleware('auth')
    ->name('posts.like');
});
// comment
Route::post('/posts/{post}/comments',[CommentController::class,'store'])
->middleware('auth')
->name('comments.store');
