<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
Route::get('/feed', [PostController::class, 'index'])->name('feed');
