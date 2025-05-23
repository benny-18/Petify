<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function auth()
    {
        return view('auth');
    }

    public function dashboard()
    {
    $projects = Auth::user()->projects;

    return response()
        ->view('dashboard', compact('projects'))
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
        ->header('Pragma', 'no-cache')
        ->header('Expires', '0');
    }
     
}