<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required'
        ]);

        $loginField = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$loginField => $credentials['login'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ])->withInput($request->except('password'));
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|min:3|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'min:6',
                'confirmed',
                'regex:/^(?=.*[A-Z])(?=.*[0-9])/',
            ]
        ], [
            'password.regex' => 'The password must contain at least one capital letter and one number.',
        ]);

        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'profile_photo' => 'default-profile-picture.png' // Default profile picture
        ]);

        Auth::login($user);
        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function showProfile()
    {
        return view('user.profile', ['user' => Auth::user()]);
    }

    public function updateProfilePhoto(Request $request)
    {
        // Validate file upload
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file
        ]);

        $user = Auth::user();

        // Delete old profile photo if it's not the default
        if ($user->profile_photo !== 'default-profile-picture.png' && Storage::exists('public/profile_photos/' . $user->profile_photo)) {
            Storage::delete('public/profile_photos/' . $user->profile_photo);
        }

        // Try to save the new profile photo
        try {
            // Generate unique filename for the uploaded photo
            $filename = time() . '.' . $request->profile_photo->extension();
            // Store the file in 'public/profile_photos' directory
            $request->profile_photo->storeAs('public/profile_photos', $filename);

            // Update the user's profile photo in the database
            $user->profile_photo = $filename;
            $user->save();

            return back()->with('success', 'Profile photo updated successfully.');
        } catch (\Exception $e) {
            // Handle any exception that occurs during file upload
            return back()->with('error', 'There was an error updating your profile photo.');
        }
    }
}
