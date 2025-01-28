<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPatientController extends Controller
{
    public function redirectToPatients()
    {
        // Ensure this returns the correct view
        return view('admin.patient_admin'); 
    }
}
