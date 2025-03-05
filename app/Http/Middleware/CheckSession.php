<?php
// app/Http/Middleware/CheckSession.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSession
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is not authenticated
        if (!Auth::check()) {
            // Flash message for session timeout
            return redirect()->route('login.form')->with('status', 'You have been logged out by the system.');
        }

        return $next($request);
    }
}

