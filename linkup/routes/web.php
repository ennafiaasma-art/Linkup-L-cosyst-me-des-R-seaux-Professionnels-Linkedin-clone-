<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
Route::get('/feed', [PostController::class, 'index'])->name('feed');
Route::get('/register',[])->name('show.register');
Route::get('/login',[])->name("show.login");
