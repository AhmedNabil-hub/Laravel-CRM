<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', fn() => redirect()->route('home'));

Route::middleware(['auth'])->group(function () {
  Route::resource('users', UserController::class);
  Route::resource('clients', ClientController::class);
  Route::resource('projects', ProjectController::class);
  Route::resource('tasks', TaskController::class);
});


