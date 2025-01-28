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
     * Display the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login'); // This should be your login form
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
    
        // Attempt to log the user in
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $request->filled('remember'))) {
            // Regenerate session to avoid session fixation
            $request->session()->regenerate();
    
            // Get the user
            $user = Auth::user();
    
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
    
            // Check the user_type and redirect accordingly
            if (Auth::user()->user_type === 'Admin') {
                // Redirect to admin page if user type is Admin
                return redirect()->intended('/admin');
            } else {
                // Redirect to the index page if user type is not Admin
                return redirect('/index');
            }
        }
    
        // Authentication failed, redirect back with an error message
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
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
