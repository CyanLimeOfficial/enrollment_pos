<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPatientListController extends Controller
{
    public function redirectToPatientList()
    {
        // Ensure this returns the correct view
        return view('admin.archive.patientList_archive_admin'); 
    }
}