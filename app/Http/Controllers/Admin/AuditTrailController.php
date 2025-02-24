<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\AuditTrail;


class AuditTrailController extends Controller
{
    /**
     * Display the audit trail logs.
     */
    public function redirectToAuditTrails()
    {
        $logs = AuditTrail::orderBy('created_at', 'desc')->get();
        return view('admin.audit_trails_admin', compact('logs'));
    }
}
