<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Livewire\PosterEditor;

//register and login in one ui
Route::get('/', function () {return view('welcome'); });
Route::get('/welcome', function () {return view('welcome'); });
Route::get('/login', function () {return view('login'); });
Route::get('/register', function () {return view('login'); });

Route::view('/terms-and-conditions', 'terms')->name('terms');

Route::get('/editor', function () {return view('editor'); });

Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/register', [UserController::class, 'register'])->name('register');

// Show dashboard after login
Route::get('/dashboard', [UserController::class, 'dashboard'])
    ->middleware('auth')
    ->name('dashboard');

//profile update
Route::middleware('auth')->group(function () {
    Route::post('/dashboard/profile', [UserController::class, 'update'])->name('profile.update');
});

//password checker
Route::post('/check-password', [UserController::class, 'checkPassword'])->name('check.password');

//create project route
Route::post('/dashboard/project-create', [ProjectController::class, 'store'])
    ->middleware('auth')
    ->name('project.store');

// Redirect to project
Route::get('/editor/{id}', [ProjectController::class, 'edit'])->name('project.editor');

// Delete project
Route::delete('/dashboard/{project}', [ProjectController::class, 'destroy'])
    ->name('project.destroy')
    ->middleware('auth');

// Save project - update
Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('project.update');

// Logout route
Route::post('/logout', function() {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// livewrire chuchu
Route::get('/editor', PosterEditor::class)->name('editor');
Route::post('/projects/{project}/change-template', [ProjectController::class, 'changeTemplate']);
Route::post('/projects/upload-thumbnail', [ProjectController::class, 'uploadThumbnail']);
