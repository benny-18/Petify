<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

//register and login in one ui
Route::get('/login', function () {return view('login'); });
Route::get('/register', function () {return view('login'); });

Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/dashboard', function() {
    return view('dashboard');
})->middleware('auth');



