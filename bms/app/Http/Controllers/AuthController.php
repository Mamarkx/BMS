<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\SendEmailOTP;
use App\Models\TwoFactorCode;

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
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function RegisterAcc(Request $request)
    {
        $validated = $request->validate([
            'first_name'   => 'required|string|max:255',
            'middle_name'  => 'nullable|string|max:255',
            'last_name'    => 'required|string|max:255',
            'suffix'       => 'nullable|string|max:255',
            'address'      => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required|string|confirmed',
            'terms'        => 'accepted',
        ]);
        $user = User::create([
            'first_name'  => $validated['first_name'],
            'middle_name' => $validated['middle_name'] ?? null,
            'last_name'   => $validated['last_name'],
            'suffix'      => $validated['suffix'] ?? null,
            'address'     => $validated['address'],
            'email'       => $validated['email'],
            'password'    => Hash::make($validated['password']),
        ]);
        $this->sendOtp($user);
        session(['pending_verification_email' => $user->email]);
        return redirect()
            ->route('verify.email.page')
            ->with('success', 'Registration successful! We sent a verification code to your email.');
    }

    public function loginAcc(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'This email is not registered.',
            ])->onlyInput('email');
        }
        if (!$user->is_verified) {
            session([
                'show_verification_modal' => true,
                'pending_verification_email' => $user->email,
            ]);

            return back();
        }
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'Incorrect password. Please try again.',
            ])->onlyInput('email');
        }


        // ✅ Verified and password correct
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended('/')
            ->with('success', 'Welcome, ' . $user->first_name . '!');
    }



    public function showVerifyEmailPage()
    {
        $email = session('pending_verification_email');

        if (!$email) {
            return redirect()->route('login')->with('error', 'No verification pending.');
        }

        return view('website.auth.verify-email', compact('email'));
    }

    public function resendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->firstOrFail();
        $latestOtp = TwoFactorCode::where('user_id', $user->id)->latest()->first();
        if ($latestOtp && $latestOtp->created_at->diffInSeconds(now()) < 60) {
            return response()->json(['message' => 'Please wait before requesting another OTP.'], 429);
        }

        $this->sendOtp($user);

        return response()->json(['message' => 'New OTP has been sent to your email.']);
    }


    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp'   => 'required|digits:6',
        ]);

        $user = User::where('email', $request->email)->firstOrFail();

        $emailOtp = TwoFactorCode::where('user_id', $user->id)
            ->latest()
            ->first();

        if (!$emailOtp) {
            return back()->with('error', 'No OTP found. Please request a new one.');
        }

        if ($emailOtp->isExpired()) {
            $emailOtp->delete();
            return back()->with('error', 'Your OTP has expired. Please request a new one.');
        }
        if ($emailOtp->code != $request->otp) {
            return back()->with('error', 'Invalid OTP. Please try again.');
        }
        $emailOtp->delete();
        $user->update(['is_verified' => true]);
        session()->forget('pending_verification_email');

        return redirect()->route('loginPage')->with('success_verified', true);
    }



    private function SendOtp($user)
    {
        $code = rand(100000, 999999);

        TwoFactorCode::create([
            'user_id'    => $user->id,
            'code'       => $code,
            'expires_at' => Carbon::now('Asia/Manila')->addMinutes(10), // 🇵🇭 Philippine Time
        ]);

        Mail::to($user->email)->send(new SendEmailOTP($user, $code));
    }
}
