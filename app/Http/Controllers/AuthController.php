<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
