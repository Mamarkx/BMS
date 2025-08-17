<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
