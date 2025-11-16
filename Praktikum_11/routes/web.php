<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/signin', [AuthController::class, 'signin']);
Route::get('/signup', [AuthController::class, 'signup']);
Route::resource('category', CategoryController::class);
