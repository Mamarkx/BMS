<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function ShowLogin()
    {
        return view('website.auth.login');
    }
    public function ShowRegister()
    {
        return view('website.auth.register');
    }
    public function destroy(Request $request)
    {
        Auth::logout(); // Logs out the authenticated user

        $request->session()->invalidate(); // Invalidates the session
        $request->session()->regenerateToken(); // Regenerates CSRF token

        return redirect('/login'); // Redirects the user to the login page
    }
    public function RegisterAcc(Request $request)
    {
        // Dump the request data to see what the form is sending


        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed',
            'terms' => 'accepted',
        ]);

        User::create([
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'],
            'last_name' => $validated['last_name'],
            'suffix' => $validated['suffix'],
            'address' => $validated['address'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('loginPage')
            ->with('success', 'Registration successful. Please log in.');
    }
    public function loginAcc(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('/')
                ->with('success', 'Welcome, ' . Auth::user()->first_name . '!'); // Added punctuation for better formatting
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->onlyInput('email');
    }
}
