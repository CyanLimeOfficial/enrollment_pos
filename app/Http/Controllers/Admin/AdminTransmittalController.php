<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminTransmittalController extends Controller
{
    public function redirectToTransmittal()
    {
        // Ensure this returns the correct view
        return view('admin.archive.transmittal_archive_admin'); 
    }
}