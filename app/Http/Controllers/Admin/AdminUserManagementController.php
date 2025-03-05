<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CreateUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AdminUserManagementController extends Controller
{
    public function redirectToUserManagement()
    {
        // Get the currently logged-in user's ID
        $loggedInUserId = auth()->id();
    
        // Fetch all users except the logged-in user
        $users = User::where('id', '!=', $loggedInUserId)->get();
    
        // Process each user to include base64 profile picture
        foreach ($users as $user) {
            if ($user->profile_picture) {
                try {
                    // Convert binary data to base64-encoded string
                    $user->profile_picture_base64 = 'data:image/jpeg;base64,' . base64_encode($user->profile_picture);
                } catch (\Exception $e) {
                    // Log the error and use a placeholder image
                    \Log::error('Error processing profile picture for user ID: ' . $user->id);
                    $user->profile_picture_base64 = asset('assets/images/profile/default_image.png');
                }
            } else {
                // Provide a default placeholder image
                $user->profile_picture_base64 = asset('assets/images/profile/default_image.png');
            }
        }
    
        // Return the view with the users' data
        return view('admin.user_management_admin', compact('users'));
    }
    

    public function deleteUser($id)
    {
        try {
            // Find the user by ID
            $user = User::findOrFail($id);
    
            // Check if the user is an Admin
            if ($user->user_type === 'Admin') {
                // Redirect back with an error message
                return redirect()->route('admin.user-management')->with('error', 'Admin users cannot be deleted.');
            }
    
            // Delete the user
            $user->delete();
    
            // Redirect back with a success message
            return redirect()->route('admin.user-management')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            // Redirect back with an error message if something goes wrong
            return redirect()->route('admin.user-management')->with('error', 'Failed to delete the user.');
        }
    }

    public function resetPassword($id)
    {
        try {
            // Find the user by ID
            $user = User::findOrFail($id);
    
            // Generate a new 5-digit password
            $newPassword = $this->generateRandomPassword();
    
            // Update the user's password (hash it before saving)
            $user->password = bcrypt($newPassword);
            $user->save();
    
            // Return the new password along with username and ID in the response
            return redirect()->route('admin.user-management')
                ->with('success', "Password reset successful for User: {$user->username} (ID: {$user->id}). New password: {$newPassword}");
        } catch (\Exception $e) {
            return redirect()->route('admin.user-management')
                ->with('error', 'Failed to reset the password. Please try again.');
        }
    }
    
    // Helper function to generate a 5-digit random password
    private function generateRandomPassword()
    {
        return str_pad(random_int(0, 99999), 5, '0', STR_PAD_LEFT); // Ensures 5 digits
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
    
        // Toggle the user's active status
        $user->is_active = !$user->is_active;
        $user->save();
    
        // If the user is deactivated, delete their session
        if (!$user->is_active) {
            DB::table('sessions')->where('user_id', $user->id)->delete(); // Remove session
        }
    
        return redirect()->route('admin.user-management')->with('success', 'User status updated successfully.');
    }
    
    
    public function storeUser(Request $request)
    {
        // Validate the input data
        $validator = Validator::make($request->all(), [
            'username' => 'required|alpha_num|max:20',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z]).+$/',
            'email' => 'required|email',
            'number' => 'required|regex:/^\d{11}$/',
            'first_name' => 'required|alpha_spaces',  // Use the custom rule here
            'last_name' => 'required|alpha_spaces',   // Use the custom rule here
            'profile_picture' => 'required|image|max:10240',
            'user_type' => 'required|in:Admin,User'
        ]);
        
    
            // Handle file upload for profile picture
            $profilePicture = $request->file('profile_picture');
            
            // Read the image as a binary stream
            $profilePictureData = file_get_contents($profilePicture->getRealPath());  // Convert the image to binary data

    
        // Create the user
        $user = CreateUser::create([  // Ensure you use CreateUser here
            'username' => $request->input('username'), 
            'password' => Hash::make($request->input('password')),
            'email' => $request->input('email'),
            'number' => $request->input('number'),
            'first_name' => $request->input('first_name'),
            'middle_name' => $request->input('middle_name'),
            'last_name' => $request->input('last_name'),
            'suffix' => $request->input('suffix'),
            'profile_picture' => $profilePictureData,
            'user_type' => $request->input('user_type'),
        ]);
    
        return redirect()->route('admin.user-management')->with('success', 'User created successfully');
    }
    
    
}
