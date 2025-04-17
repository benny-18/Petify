<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;

//register and login in one ui
Route::get('/', function () {return view('login'); });
Route::get('/login', function () {return view('login'); });
Route::get('/register', function () {return view('login'); });

Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/register', [UserController::class, 'register'])->name('register');

//show dashbaord per user 
Route::get('/dashboard', function() {
    return view('dashboard');
})->middleware('auth');

//create project route
Route::post('/dashboard', [ProjectController::class, 'store'])
    ->middleware('auth')
    ->name('project.store');

// Delete project
Route::delete('/dashboard/{project}', [ProjectController::class, 'destroy'])
    ->name('project.destroy')
    ->middleware('auth');

// Logout route
Route::post('/logout', function() {
    Auth::logout();
    return redirect('/login');
})->name('logout');

