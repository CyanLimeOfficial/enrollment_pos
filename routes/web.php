<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\Admin\AdminPatientController; 
use App\Http\Controllers\Admin\AdminPatientListController; 
use App\Http\Controllers\Admin\AdminTransmittalController; 
use App\Http\Controllers\Admin\AdminUserManagementController;
use App\Models\User;
use App\Models\create_user;

// Redirect root URL to /index
Route::redirect('/', '/index');

// Show the login form (default route for login page)
Route::get('/index', function () {
    return view('login');
});

// Handle the login request
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Logout Route to invalidate session
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



// =========================== ADMIN PANEL ====================================
// This is web routes for ADMIN

// After successful login, redirect to a user-specific page (or a default dashboard)
Route::get('/admin', [AdminDashboardController::class, 'redirectToDashboard'])->middleware('auth');

// --------------- Patient ------------------

// Redirect to Patient Panel
Route::prefix('/admin')->middleware('auth')->group(function () {
    Route::get('patients', [AdminPatientController::class, 'redirectToPatients'])->name('admin.patient_admin');
});
    // Preview the Transmittal ID to the preview modal
    Route::get('/get-latest-transmittal', function () {
        $latestTransmittal = DB::table('transmittals')
            ->select('transmittal_id')
            ->where('transmittal_id', 'LIKE', '000-%') // Ensure correct format
            ->orderByRaw("CAST(SUBSTRING(transmittal_id, 5, 5) AS UNSIGNED) DESC")
            ->first();
    
        // Extract numeric part and increment
        if ($latestTransmittal && preg_match('/000-(\d+)/', $latestTransmittal->transmittal_id, $matches)) {
            $numericPart = intval($matches[1]) + 1;
        } else {
            $numericPart = 1;
        }
    
        // Format the new transmittal ID as "000-00001"
        $newTransmittalId = sprintf('000-%05d', $numericPart);
    
        return response()->json(['transmittal_id' => $newTransmittalId]);
    });
    // Creating Patients and its Dependent
    Route::post('/admin/patients/store', [AdminPatientController::class, 'store'])->name('patients.store');

    // Download Attachment
    Route::get('/patients/download/{id}/{attachment}', [AdminPatientController::class, 'download'])->name('patients.download');
    Route::get('/patients/download-2/{id}/{attachment}', [AdminPatientController::class, 'download_2'])->name('patients.download_2');
    
    // Generate Transmittal Form
    Route::post('/admin/patients/transmittal-form', [AdminPatientController::class, 'exportTransmittal'])
    ->name('patients.store.transmittal');


    // ============== ACTION BUTTONS =================
    Route::delete('admin/patients/delete/{id}', [AdminPatientController::class, 'deletePatient'])->name('patients.delete');
    Route::post('admin/patients/add-dependent', [AdminPatientController::class, 'addDependent'])->name('patients.add_dependent');
    // Add this route to fetch the dependents and member info
    Route::get('admin/patients/get_dependents', [AdminPatientController::class, 'getDependents'])->name('patients.get_dependents');
    Route::get('admin/patients/get-patient-details/{id}', [AdminPatientController::class, 'getPatientDetails'])
    ->name('admin.view_details');
    Route::put('/admin/patients/get-patient-details/update-details/{patient}', [AdminPatientController::class, 'updatePatientDetails'])
    ->name('admin.update_details');

// --------------- Archive ------------------

// Redirect to Archive/Patient List
Route::prefix('/admin')->middleware('auth')->group(function () {
    Route::get('archive-patient-list', [AdminPatientListController::class, 'redirectToPatientList'])->name('admin.archive.patientList_archive_admin');
});
Route::get('/admin/archive-transmittal/download/{transmittalId}', [AdminPatientListController::class, 'downloadByTransmittalId'])
    ->name('transmittal.downloadById');

// Redirect to Archive Transmittal
Route::prefix('/admin')->middleware('auth')->group(function () {
    Route::get('archive-transmittal', [AdminTransmittalController::class, 'redirectToTransmittal'])->name('admin.archive.transmittal_archive_admin');
});
    // Route for downloading a transmittal attachment
    Route::get('/transmittals/{id}/download', [AdminTransmittalController::class, 'download'])->name('transmittals.download');
    Route::get('/transmittals/{id}/preview', [AdminTransmittalController::class, 'preview'])
        ->name('transmittals.preview');
// --------------- User Management ------------------

Route::prefix('/admin')->middleware('auth')->group(function () {
    // Redirect to User Management
    Route::get('user-management', [AdminUserManagementController::class, 'redirectToUserManagement'])
        ->name('admin.user-management');
    
    // ============== ACTION BUTTONS =================
    // Delete User
    Route::delete('user-management/{id}', [AdminUserManagementController::class, 'deleteUser'])
        ->name('admin.user-management.delete');
    // Password Reset
    Route::post('/admin/user-management/reset-password/{id}', [AdminUserManagementController::class, 'resetPassword'])
        ->name('admin.user-management.reset-password');
        

    // ============= ADD USER ====================
    // Handles Add User to store to database  
    Route::post('/store_user', [AdminUserManagementController::class, 'storeUser'])->name('store.user');
});



