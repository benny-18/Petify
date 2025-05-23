<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ], [
            'password.min' => 'Password must be at least 8 characters',
            'email.unique' => 'This email is already taken.',
        ]);

        if ($validator->fails()) {
            if ($validator->errors()->has('email')) {
                return back()
                    ->withErrors(['emailExists' => $validator->errors()->first('email')])
                    ->withInput();
            }

            return back()->withErrors($validator)->withInput();
        }

        try {
            User::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('login')->with('registered', true);
        } catch (QueryException $e) {
            return back()->withErrors(['emailExists' => 'An unexpected error occurred.'])->withInput();
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $request->remember)) {
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials are incorrect',
        ]);
    }
}