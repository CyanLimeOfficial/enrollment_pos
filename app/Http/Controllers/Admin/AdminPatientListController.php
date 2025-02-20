<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PosPatient;
use App\Models\PosPatientDependant;
use Carbon\Carbon;

class AdminPatientListController extends Controller
{
    public function redirectToPatientList()
    {
        // Fetch patients along with their dependents
        $patients = PosPatient::leftJoin('pos_patients_dependants', 'pos_patients.health_record_id', '=', 'pos_patients_dependants.health_record_id_relation_2')
            ->select(
                'pos_patients.health_record_id as health_record_id',
                'pos_patients.status',
                'pos_patients.admission_date',
                'pos_patients.discharge_date',
                'pos_patients.reason_or_purpose',
                'pos_patients.philhealth_id as pin',
                'pos_patients.attachment_1',
                'pos_patients.attachment_type_1',
                'pos_patients.member_first_name',
                'pos_patients.member_middle_name',
                'pos_patients.member_last_name',
                'pos_patients.member_extension_name',
                'pos_patients.date_of_birth',
                'pos_patients.archive_lock_1', // For members without dependents
                'pos_patients.transmittal_id_1', // For members without dependents
                'pos_patients_dependants.dependent_hospital_id',
                'pos_patients_dependants.dependent_first_name',
                'pos_patients_dependants.dependent_middle_name',
                'pos_patients_dependants.dependent_last_name',
                'pos_patients_dependants.dependent_extension_name',
                'pos_patients_dependants.dependent_date_of_birth',
                'pos_patients_dependants.dependent_relationship',
                'pos_patients_dependants.status_2',
                'pos_patients_dependants.admission_date_2',
                'pos_patients_dependants.discharge_date_2',
                'pos_patients_dependants.attachment_2',
                'pos_patients_dependants.attachment_type_2',
                'pos_patients_dependants.reason_or_purpose2',
                'pos_patients_dependants.archive_lock_2', // For members with dependents
                'pos_patients_dependants.transmittal_id_2' // For members with dependents
            )
            ->get()
            ->groupBy('health_record_id') // Group rows by patient to prevent duplicates
            ->map(function ($group) {
                $patient = $group->first(); // The first row holds the member's info
            
                // Format member full name
                $memberNameParts = array_filter([
                    $patient->member_first_name,
                    $patient->member_middle_name,
                    $patient->member_last_name,
                    $patient->member_extension_name
                ]);
                $patient->member_full_name = implode(' ', $memberNameParts);
            
                // Calculate expiry and remaining days for the member
                if ($patient->admission_date) {
                    $patient->member_date_of_expiry = Carbon::parse($patient->admission_date)
                        ->addDays(61)
                        ->format('Y-m-d');
                    $patient->member_remaining_days = (int) max(0, Carbon::parse($patient->admission_date)
                        ->addDays(61)
                        ->diffInDays(Carbon::now()));
                    $patient->member_discharge_days = (int) max(0, Carbon::parse($patient->discharge_date)
                        ->addDays(61)
                        ->diffInDays(Carbon::now()));
                } else {
                    $patient->member_date_of_expiry = 'N/A';
                    $patient->member_remaining_days = 0;
                }
            
                // Process dependents
                $dependents = $group->map(function ($dependent) {
                    // Format dependent full name
                    $dependentNameParts = array_filter([
                        $dependent->dependent_first_name,
                        $dependent->dependent_middle_name,
                        $dependent->dependent_last_name,
                        $dependent->dependent_extension_name
                    ]);
                    $dependent->dependent_full_name = implode(' ', $dependentNameParts);
            
                    // Default if no dependent info is available
                    if (empty($dependentNameParts)) {
                        $dependent->dependent_full_name = 'No dependent information available';
                    }
            
                    // Calculate expiry and remaining days for each dependent
                    if ($dependent->admission_date_2) {
                        $dependent->date_of_expiry = Carbon::parse($dependent->admission_date_2)
                            ->addDays(61)
                            ->format('Y-m-d');
                        $dependent->remaining_days = (int) max(0, Carbon::parse($dependent->admission_date_2)
                            ->addDays(61)
                            ->diffInDays(Carbon::now()));
                    } else {
                        $dependent->remaining_days = 0;
                    }
            
                    // Attachment for each dependent
                    if ($dependent->attachment_2) {
                        $dependent->attachment_link = route('patients.download', [
                            'id' => $dependent->health_record_id,
                            'attachment' => 2
                        ]);
                        $dependent->attachment_type = $dependent->attachment_type_2;
                    } else {
                        $dependent->attachment_link = 'No Attachment';
                        $dependent->attachment_type = 'N/A';
                    }
            
                    return $dependent;
                });
            
                // Attach dependents to the patient record
                $patient->dependents = $dependents;
            
                return $patient;
            });
        
            // Filter based on archive_lock flags:
            // 1. If the member has no dependent, show only if archive_lock_1 equals 1.
            // 2. If the member has dependents, filter the dependents to only include those with archive_lock_2 equal to 1,
            //    and only show the patient if the filtered dependents collection is not empty.
            $patients = $patients->filter(function ($patient) {
                if (is_null($patient->dependent_hospital_id)) {
                    // No dependent – check the member's archive_lock_1 flag
                    return $patient->archive_lock_1 == 1;
                } else {
                    // Has dependents – filter dependents to include only those with archive_lock_2 equal to 1
                    $patient->dependents = $patient->dependents->filter(function ($dependent) {
                        return $dependent->archive_lock_2 == 1;
                    });
                    // Only show this patient if there's at least one dependent with archive_lock_2 equals 1
                    return $patient->dependents->isNotEmpty();
                }
            });

        
        return view('admin.archive.patientList_archive_admin', compact('patients'));
    }

    public function downloadByTransmittalId($transmittalId)
{
    // Find the transmittal record by comparing the transmittal_id string.
    // This compares the given string with the stored transmittal_id column.
    $transmittal = \App\Models\Transmittal::where('transmittal_id', $transmittalId)->firstOrFail();

    // Check if the attachment exists in the BLOB field.
    if ($transmittal->attachment_transmittal) {
        $fileContent = $transmittal->attachment_transmittal;

        // Construct a file name using the transmittal ID.
        $fileName = $transmittal->transmittal_id . '-transmittal.xlsx';
        $fileType = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'; // MIME type for Excel files

        // Return the file as a downloadable response.
        return response($fileContent)
            ->header('Content-Type', $fileType)
            ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
    }

    abort(404, "Attachment not found for transmittal id: $transmittalId");
}
    
}