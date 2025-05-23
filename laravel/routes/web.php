<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Livewire\PosterEditor;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('login');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::view('/terms-and-conditions', 'terms')->name('terms');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])
    ->middleware('auth')
    ->name('dashboard');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::middleware('auth')->group(function () {
    Route::post('/dashboard/profile', [UserController::class, 'update'])->name('profile.update');
});

Route::post('/check-password', [UserController::class, 'checkPassword'])->name('check.password');

Route::post('/dashboard/project-create', [ProjectController::class, 'store'])
    ->middleware('auth')
    ->name('project.store');

Route::delete('/dashboard/{project}', [ProjectController::class, 'destroy'])
    ->name('project.destroy')
    ->middleware('auth');

Route::get('/editor/{id}', [ProjectController::class, 'edit'])->name('project.editor');

Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('project.update');

Route::get('/editor', PosterEditor::class)->name('editor');
Route::post('/projects/{project}/change-template', [ProjectController::class, 'changeTemplate']);
Route::post('/projects/upload-thumbnail', [ProjectController::class, 'uploadThumbnail']);