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
    public function update(Request $request)
    {
    $user = Auth::user();

    $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id, 
        'old_password' => 'nullable|string',
        'new_password' => 'nullable|string|min:8|confirmed',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $user->firstname = $request->firstname;
    $user->lastname = $request->lastname;
    $user->email=$request->email;

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

    
    public function checkPassword(Request $request)
    {
    $user = auth()->user();
    $isCorrect = Hash::check($request->password, $user->password);

    return response()->json(['match' => $isCorrect]);
    }
}