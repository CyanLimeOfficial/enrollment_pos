<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            $user = Auth::user();

            // If the user is deactivated, log them out and redirect
            if (!$user->is_active) {
                Auth::logout(); // Log out the user
                $request->session()->invalidate(); // Invalidate the session
                $request->session()->regenerateToken(); // Regenerate CSRF token

                return redirect()->route('login')->with('error', 'Your account has been deactivated.');
            }
        }

        return $next($request);
    }
}