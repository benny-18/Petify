<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function auth()
    {
        return view('auth');
    }

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

    public function dashboard()
    {
        $projects = Auth::user()->projects;
        return view('dashboard', compact('projects'));
    }

    public function update(Request $request)
    {
    $user = Auth::user();

    $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'old_password' => 'nullable|string',
        'new_password' => 'nullable|string|min:8|confirmed',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $user->firstname = $request->firstname;
    $user->lastname = $request->lastname;

    if ($request->hasFile('profile_picture')) {
        // Delete old profile picture if exists
        if ($user->profile_picture && file_exists(storage_path('app/public/' . $user->profile_picture))) {
            unlink(storage_path('app/public/' . $user->profile_picture));
        }

        $profilePicture = $request->file('profile_picture');
        $imagePath = $profilePicture->store('profile_pictures', 'public');

        $user->profile_picture = $imagePath;
    }

    if ($request->filled('old_password') && $request->filled('new_password')) {
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Old password is incorrect.']);
        }

        $user->password = Hash::make($request->new_password);
    }

    $user->save();

    return back()->with('success', 'Profile updated successfully!')->with('show_profile_modal', true);
    }   

    //password checker
    public function checkPassword(Request $request)
    {
    $user = auth()->user();
    $isCorrect = Hash::check($request->password, $user->password);

    return response()->json(['match' => $isCorrect]);
    }
}