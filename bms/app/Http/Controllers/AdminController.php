<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TwoFactorCode;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\TwoFactorCodeMail;

class AdminController extends Controller
{
    public function Adminlogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if (!in_array($user->role, ['Admin', 'Super Admin'])) {
                Auth::logout();
                return back()->withErrors(['email' => 'Only Admin and Super Admin can login.']);
            }

            // Remove existing 2FA codes for the user
            TwoFactorCode::where('user_id', $user->id)->delete();

            // Generate 6-digit 2FA code
            $code = rand(100000, 999999);

            // Store in separate table
            TwoFactorCode::create([
                'user_id' => $user->id,
                'code' => $code,
                'expires_at' => Carbon::now()->addMinutes(10),
            ]);

            // Send code via email
            Mail::to($user->email)->send(new TwoFactorCodeMail($user, $code));

            // Logout until 2FA verified
            Auth::logout();

            // Store user ID in session for verification
            $request->session()->put('2fa:user:id', $user->id);

            return redirect()->route('admin.2fa.form');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.'
        ])->onlyInput('email');
    }


    public function verify2fa(Request $request)
    {
        $request->validate([
            'two_factor_code' => 'required',
        ]);

        $userId = $request->session()->get('2fa:user:id');
        if (!$userId) {
            return redirect()->route('LoginAdmin')->withErrors('Session expired, login again.');
        }

        $twoFA = \App\Models\TwoFactorCode::where('user_id', $userId)
            ->where('code', $request->two_factor_code)
            ->where('expires_at', '>', now())
            ->first();

        if (!$twoFA) {
            return back()->withErrors('Invalid or expired 2FA code.');
        }

        // Delete used code
        $twoFA->delete();

        // Log the user in fully
        $user = \App\Models\User::find($userId);
        Auth::login($user);

        // Mark 2FA as verified for this session
        $request->session()->put('2fa:verified', true);

        // Forget temporary session variable
        $request->session()->forget('2fa:user:id');

        // Redirect to intended page or dashboard
        return redirect()->intended(route('dash'));
    }

    public function Adminlogout()
    {
        // Logout the user
        Auth::logout();

        // Invalidate the session
        request()->session()->invalidate();

        // Regenerate CSRF token
        request()->session()->regenerateToken();

        // Redirect to login page with a success message
        return redirect()->route('LoginAdmin')->with('success', 'Logged out successfully.');
    }
}
