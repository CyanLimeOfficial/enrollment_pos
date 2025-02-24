<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function redirectToReports()
    {
        return view('admin.reports_admin'); // Adjust view path as needed
    }
}
