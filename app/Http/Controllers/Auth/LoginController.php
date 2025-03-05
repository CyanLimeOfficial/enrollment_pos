<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Display the login form or redirect based on session.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        // Check if user is already authenticated
        if (Auth::check()) {
            return $this->redirectBasedOnUserType();
        }

        // Redirect to `/index` instead of `auth.login`
        return view('login');
    }

    /**
     * Handle the login attempt.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validate the login form
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Find user by username
        $user = User::where('username', $request->username)->first();

        // Check if user exists and is active
        if ($user && $user->is_active == 0) {
            return back()->withErrors([
                'username' => 'Your account has been deactivated. Please contact the administrator.',
            ]);
        }

        // Attempt to log the user in
        if ($user && Auth::attempt(['username' => $request->username, 'password' => $request->password], $request->filled('remember'))) {
            // Regenerate session to avoid session fixation
            $request->session()->regenerate();

            // Check if profile picture exists and convert to base64
            $profile_picture_base64 = null;
            if ($user->profile_picture) {
                // Assuming profile_picture is stored as a BLOB in the database
                $profile_picture_base64 = 'data:image/jpeg;base64,' . base64_encode($user->profile_picture);
            }

            // Store user details in session
            session([
                'first_name' => $user->first_name,
                'middle_name' => $user->middle_name,
                'last_name' => $user->last_name,
                'suffix' => $user->suffix,
                'user_type' => $user->user_type,
                'email' => $user->email,
                'profile_picture' => $profile_picture_base64, // Store the base64 image in session
            ]);

            // Redirect based on user type
            return $this->redirectBasedOnUserType();
        }

        // Authentication failed, redirect back with an error message
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Redirect user based on their type.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectBasedOnUserType()
    {
        if (Auth::user()->user_type === 'Admin') {
            return redirect()->intended('/admin');
        }

        return redirect()->intended('/index');
    }

    /**
     * Check session and redirect to login if no active session.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function checkSession()
    {
        // If no active authentication, redirect to login
        if (!Auth::check()) {
            return redirect('/index');
        }

        // If authenticated, redirect based on user type
        return $this->redirectBasedOnUserType();
    }

    /**
     * Logout the user and invalidate the session.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Logout the user
        Auth::logout();

        // Invalidate the session and regenerate the token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the login page
        return redirect('/index');
    }
}
