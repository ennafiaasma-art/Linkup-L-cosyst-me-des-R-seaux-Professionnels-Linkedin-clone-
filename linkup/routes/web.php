<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
Route::get('/feed', [PostController::class, 'index'])->name('feed');
Route::get('/register',[AuthController::class, 'showRegister'])->name('show.register');
Route::get('/login',[AuthController::class, 'showLogin'])->name("show.login");
