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
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate(); //invalidate the user session   
        $request->session()->regenerateToken(); //regenerate token
        return redirect('/');
    }
}
