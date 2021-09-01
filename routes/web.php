<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
  Route::resource('users', UserController::class);
  Route::resource('clients', UserController::class);
  Route::resource('projects', UserController::class);
  Route::resource('tasks', UserController::class);
});


