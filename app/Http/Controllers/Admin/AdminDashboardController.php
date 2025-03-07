<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PosPatientDependant;
use App\Models\PosPatient;
use App\Models\User;
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
    
        // Get all members with status 'For Update' (all records, not only today)
        $memberForUpdate = PosPatient::where('status', 'For Update')->count();
    
        // Get all dependents with status 'For Update' (all records)
        $dependentForUpdate = PosPatientDependant::where('status_2', 'For Update')->count();
    
        // Get all members with status 'Already Updated' (all records)
        $memberAlreadyUpdated = PosPatient::where('status', 'Already Updated')->count();
    
        // Get all dependents with status 'Already Updated' (all records)
        $dependentAlreadyUpdated = PosPatientDependant::where('status_2', 'Already Updated')->count();
    
        // Fetch members inserted by each user and create text array
        $textArray = PosPatient::with('recordedBy')
            ->select('recorded_by_user_id')
            ->selectRaw('COUNT(*) as total_members')
            ->groupBy('recorded_by_user_id')
            ->get()
            ->map(function ($member) {
                // Format the name as "Lanzarrote, Dexter"
                $userFullName = optional($member->recordedBy)->last_name . ', ' . optional($member->recordedBy)->first_name;
                return "{$userFullName} - {$member->total_members} POS Patients";
            });
    
        // Generate labels and data for the chart
        $chartData = $this->generateChartData();
    
        return view('admin.admin', [
            'textArray'         => $textArray,
            'memberToday'       => $memberToday,
            'dependentToday'    => $dependentToday,
            'ForUpdate'         => $memberForUpdate + $dependentForUpdate,
            'AlreadyUpdated'    => $memberAlreadyUpdated + $dependentAlreadyUpdated,
            'labels'            => $chartData['labels'],
            'data'              => $chartData['data'],
        ]);
    }

    private function generateChartData()
    {
        // Get all users with their first names, last names, and count of POS Patients
        $users = User::withCount('posPatients')->get();
    
        // Initialize arrays for labels and data
        $labels = [];
        $data = [];
    
        foreach ($users as $user) {
            // Format the name as "Lanzarrote, Dexter"
            $labels[] = $user->last_name . ', ' . $user->first_name;
    
            // Add the count of POS Patients for this user to the data array
            $data[] = $user->pos_patients_count;
        }
    
        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }
}