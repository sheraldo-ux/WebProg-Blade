<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
            'role' => 'contributor',
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
        return view('profile.account', ['user' => Auth::user()]);
    }

    public function updateProfilePhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        DB::beginTransaction();

        try {
            if ($user->profile_photo !== 'default-profile-picture.png') {
                Storage::disk('public')->delete('profile_photos/' . $user->profile_photo);
            }

            $filename = time() . '_' . uniqid() . '.' . $request->profile_photo->extension();
            
            $path = $request->file('profile_photo')->storeAs(
                'profile_photos', 
                $filename, 
                'public'  // This ensures the file is stored in the public disk
            );

            if (!$path) {
                throw new \Exception('Failed to store the file.');
            }

            $user->profile_photo = $filename;
            /** @var \App\Models\User $user **/
            $user->save();

            DB::commit();

            return back()->with('success', 'Profile photo updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Profile photo update error: ' . $e->getMessage());
            return back()->with('error', 'There was an error updating your profile photo. Please try again.');
        }
    }
}
