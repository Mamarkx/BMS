<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TwoFactorCode;
use App\Mail\TwoFactorCodeMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function Adminlogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);


        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No account found with that email address.'])->onlyInput('email');
        }


        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Incorrect password.'])->onlyInput('email');
        }
        if (!in_array($user->role, ['Admin', 'Super Admin'])) {
            return back()->withErrors(['email' => 'Access denied. Only Admin and Super Admin can login.'])->onlyInput('email');
        }
        Auth::login($user);
        TwoFactorCode::where('user_id', $user->id)->delete();
        $code = rand(100000, 999999);
        TwoFactorCode::create([
            'user_id' => $user->id,
            'code' => $code,
            'expires_at' => now()->addMinutes(10),
        ]);
        Mail::to($user->email)->send(new TwoFactorCodeMail($user, $code));
        Auth::logout();
        $request->session()->put('2fa:user:id', $user->id);

        return redirect()->route('admin.2fa.form');
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
    public function ShowAdminProfile()
    {
        $user = Auth::user();
        return view('AdminSide.admin-profile', compact('user'));
    }
    public function updatePersonal(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:50',
            'address' => 'required|string|max:255',
        ]);

        Auth::user()->update($request->only([
            'first_name',
            'middle_name',
            'last_name',
            'suffix',
            'address'
        ]));

        return back()->with('success', 'Personal information updated.');
    }

    public function updateAccount(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:8',
        ]);

        $user = Auth::user();
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return back()->with('success', 'Account settings updated.');
    }
}
