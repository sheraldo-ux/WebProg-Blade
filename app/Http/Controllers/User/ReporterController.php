<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReporterController extends Controller
{
    //
    public function view_update()
    {
        return view('profile.reporter.update');
    }

    public function update(Request $request, String $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'username' => 'required|string|min:3|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password'=> [
                'nullable',
                'min:6',
                'confirmed',
                'regex:/^(?=.*[A-Z])(?=.*[0-9])/',
            ]
        ], [
            'username.required' => 'The name field is required.',
            'username.min' => 'The name must be at least 3 characters.',
            'username.max' => 'The name may not be greater than 255 characters.',
            'username.unique' => 'The username has already been taken.',
            'email.required' => 'The email field is required.', 
            'email.email' => 'Email format is invalid.',
            'email.unique' => 'Email already exists.',
            'password.regex' => 'The password must contain at least one capital letter and one number.',
        ]);

        // Mengecek apakah email berubah, jika berubah maka password direset sesuai dengan email baru
        // Check if password is provided, if not, use the old password
        if (!empty($data['password'])) {
            $user->password = bcrypt($data['password']);
        }

        $user->update([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $user->password
        ]);

        return redirect()->route('profile.show_profile')->with('success', 'User updated successfully');
    }
}
