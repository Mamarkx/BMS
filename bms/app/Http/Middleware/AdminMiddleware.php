<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // 1️⃣ If user is logged in
        if (Auth::check()) {

            // Only allow admin role
            if (Auth::user()->role !== 'Admin') {
                Auth::logout();
                return redirect()->route('LoginAdmin')->with('error', 'Only Admin Can Access This!');
            }

            // 2️⃣ Prevent logged-in admin from accessing login page
            if ($request->routeIs('LoginAdmin')) {
                $previous = url()->previous();

                // Avoid redirect loop if previous page is login
                if (str_contains($previous, route('LoginAdmin'))) {
                    $previous = route('dash');
                }

                return redirect($previous);
            }

            // 3️⃣ Check if 2FA verified for this session
            if (
                !$request->session()->has('2fa:verified')
                && !$request->routeIs('admin.2fa.form')
                && !$request->routeIs('admin.2fa.verify')
            ) {

                // Logout temporarily until 2FA is completed
                Auth::logout();

                // Store intended URL to redirect after 2FA
                $request->session()->put('url.intended', $request->url());

                return redirect()->route('admin.2fa.form');
            }

            return $next($request);
        }

        // 4️⃣ If not logged in and trying to access non-login page
        if (!$request->routeIs('LoginAdmin')) {
            return redirect()->route('LoginAdmin')->with('error', 'You need to login first.');
        }

        // 5️⃣ Allow login page access
        return $next($request);
    }
}
