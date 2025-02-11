<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // Ensure you import the base controller here
use Illuminate\Http\Request;
use App\Models\PosPatientDependant;
use App\Models\PosPatient;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function redirectToDashboard()
    {
        // Get today's date
        $today = Carbon::today();
    
        // Get all members registered today
        $memberToday = PosPatient::whereDate('created_at', $today)->count();
    
        // Get all dependents registered today
        $dependentToday = PosPatientDependant::whereDate('created_at', $today)->count();
    
        // Get all members with status 'For Update' registered today
        $memberForUpdate = PosPatient::whereDate('created_at', $today)
                                      ->where('status', 'For Update')
                                      ->count();
        // Get all dependents with status 'For Update' registered today
        $dependentForUpdate = PosPatientDependant::whereDate('created_at', $today)
                                                 ->where('status_2', 'For Update')
                                                 ->count();

        // Get all members with status 'For Update' registered today
        $memberAlreadyUpdated = PosPatient::whereDate('created_at', $today)
                                      ->where('status', 'Already Updated')
                                      ->count();
        // Get all dependents with status 'For Update' registered today
        $dependentAlreadyUpdated = PosPatientDependant::whereDate('created_at', $today)
                                                 ->where('status_2', 'Already Updated')
                                                 ->count();
    
        return view('admin.admin', [
            'memberToday' => $memberToday,
            'dependentToday' => $dependentToday,
            'ForUpdate' => $memberForUpdate + $dependentForUpdate,
            'AlreadyUpdated' => $memberAlreadyUpdated + $dependentAlreadyUpdated,

        ]);
    }
}