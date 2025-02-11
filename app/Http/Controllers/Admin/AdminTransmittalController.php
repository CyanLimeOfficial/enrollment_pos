<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transmittal; // Import the Transmittal model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminTransmittalController extends Controller
{
    public function redirectToTransmittal()
    {
        // Eager load the 'user' relationship to avoid N+1 query problem
        $transmittals = Transmittal::with('user')->get();

        // Pass the transmittals to the view
        return view('admin.archive.transmittal_archive_admin', compact('transmittals'));
    }

    public function download($id)
    {
        // Find the transmittal by its ID
        $transmittal = Transmittal::findOrFail($id);

        // Check if the attachment exists in the BLOB field
        if ($transmittal->attachment_transmittal) {
            // Get the binary data from the attachment_transmittal field
            $fileContent = $transmittal->attachment_transmittal;

            // Assuming the file is an Excel file (xlsx) for example:
            $fileName = $transmittal->transmittal_id . '-transmittal.xlsx';  // Customize file name as needed
            $fileType = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'; // MIME type for xlsx files

            // Return the file content as a downloadable response
            return response($fileContent)
                ->header('Content-Type', $fileType)
                ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
        }

        // Return a message if the attachment doesn't exist
        return response()->json(['error' => 'Attachment not found'], 404);
    }
}
