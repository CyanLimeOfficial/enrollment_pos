<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\Admin\AdminPatientController; 
use App\Http\Controllers\Admin\AdminPatientListController; 
use App\Http\Controllers\Admin\AdminTransmittalController; 
use App\Http\Controllers\Admin\AdminUserManagementController;
use App\Models\User;
use App\Models\create_user;


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
Route::get('/admin', function () {
    return view('admin.admin'); 
})->name('home.admin')->middleware('auth'); 

// --------------- Patient ------------------

// Redirect to Patient Panel
Route::prefix('/admin')->middleware('auth')->group(function () {
    Route::get('patients', [AdminPatientController::class, 'redirectToPatients'])->name('admin.patient_admin');
});

// --------------- Archive ------------------

// Redirect to Archive/Patient List
Route::prefix('/admin')->middleware('auth')->group(function () {
    Route::get('archive-patient-list', [AdminPatientListController::class, 'redirectToPatientList'])->name('admin.archive.patientList_archive_admin');
});

// Redirect to Archive Transmittal
Route::prefix('/admin')->middleware('auth')->group(function () {
    Route::get('archive-transmittal', [AdminTransmittalController::class, 'redirectToTransmittal'])->name('admin.archive.transmittal_archive_admin');
});

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



