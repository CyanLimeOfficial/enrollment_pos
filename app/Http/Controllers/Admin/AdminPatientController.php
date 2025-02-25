<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Log;

use App\Models\Transmittal;  // Import the Transmittal model
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransmittalExport;
use App\Models\PosPatient;
use App\Models\PosPatientDependant;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\Style\Font;


class AdminPatientController extends Controller
{
    public function generatePMRF($health_record_id)
    {
        // Fetch patient with dependents
        $patient = PosPatient::with('dependents')->findOrFail($health_record_id);
    
        // Load template
        $templatePath = storage_path('app/templates/pmrf_template.docx');
        $templateProcessor = new TemplateProcessor($templatePath);
    
        // Ensure PhilHealth ID is exactly 12 digits (pad with zeros if necessary)
        $philhealth_id = str_pad($patient->philhealth_id, 12, '0', STR_PAD_LEFT);

        // Convert the ID into an array of individual digits
        $digits = str_split($philhealth_id);

        // Chunk into groups of 4 and add spaces between each digit
        $chunks = array_map(fn($chunk) => implode(' ', $chunk), array_chunk($digits, 4));

        // Replace placeholders for the formatted PIN
        $templateProcessor->setValue('pin_1', $chunks[0] ?? 'N/A');
        $templateProcessor->setValue('pin_2', $chunks[1] ?? 'N/A');
        $templateProcessor->setValue('pin_3', $chunks[2] ?? 'N/A');

        // Determine the purpose and insert checkmark
        $purpose = strtolower($patient->purpose ?? 'N/A');
        $pur_1 = ($purpose === 'registration') ? '✔' : '';
        $pur_2 = ($purpose === 'updating/amendment') ? '✔' : '';

        // Replace placeholders in the template
        $templateProcessor->setValue('pur_1', $pur_1);
        $templateProcessor->setValue('pur_2', $pur_2);
        // Get the provider_konsulta value
        $providerKonsulta = $patient->provider_konsulta ?? '';

        // Define character limits for font reduction
        $fontSize = 12;  // Default size
        $length = strlen($providerKonsulta);
        
        if ($length > 40) {
            $fontSize = 10;
        }
        if ($length > 50) {
            $fontSize = 8;
        }
        if ($length > 60) {
            $fontSize = 6;  // Minimum size
        }
        
        // Create a TextRun for rich text formatting
        $textRun_provider_konsulta = new TextRun();
        $fontStyle = new Font();
        $fontStyle->setSize($fontSize);
        $textRun_provider_konsulta->addText($providerKonsulta, $fontStyle);

        // Insert into the Word document with complex value
        $templateProcessor->setComplexValue('provider_konsulta', $textRun_provider_konsulta);

        // Member First Name
        $memFirstName = $patient->member_first_name ?? '';
        $fontSize = 12; // Default size
        $length = strlen($memFirstName);
        if ($length > 20) {
            $fontSize = 12;
        }
        if ($length > 30) {
            $fontSize = 9;
        }
        if ($length > 40) {
            $fontSize = 8; // Minimum size
        }
        $textRun_member_first_name = new TextRun();
        $fontStyle = new Font();
        $fontStyle->setSize($fontSize);
        $textRun_member_first_name->addText($memFirstName, $fontStyle);
        $templateProcessor->setComplexValue('member_first_name', $textRun_member_first_name);

        // Member Middle Name
        $memMiddleName = $patient->member_middle_name ?? '';
        $fontSize = 12; // Default size
        $length = strlen($memMiddleName);
        if ($length > 20) {
            $fontSize = 12;
        }
        if ($length > 30) {
            $fontSize = 9;
        }
        if ($length > 40) {
            $fontSize = 8; // Minimum size
        }
        $textRun_member_middle_name = new TextRun();
        $fontStyle = new Font();
        $fontStyle->setSize($fontSize);
        $textRun_member_middle_name->addText($memMiddleName, $fontStyle);
        $templateProcessor->setComplexValue('member_middle_name', $textRun_member_middle_name);

        // Member Last Name
        $memLastName = $patient->member_last_name ?? '';
        $fontSize = 12; // Default size
        $length = strlen($memLastName);
        if ($length > 20) {
            $fontSize = 12;
        }
        if ($length > 30) {
            $fontSize = 9;
        }
        if ($length > 40) {
            $fontSize = 8; // Minimum size
        }
        $textRun_member_last_name = new TextRun();
        $fontStyle = new Font();
        $fontStyle->setSize($fontSize);
        $textRun_member_last_name->addText($memLastName, $fontStyle);
        $templateProcessor->setComplexValue('member_last_name', $textRun_member_last_name);

        // Member Extension Name
        $memExtensionName = $patient->member_extension_name ?? '';
        $fontSize = 12; // Default size
        $length = strlen($memExtensionName);
        if ($length > 5) {
            $fontSize = 10;
        }
        if ($length > 10) {
            $fontSize = 8;
        }
        if ($length > 15) {
            $fontSize = 6; // Minimum size
        }
        $textRun_member_extension_name = new TextRun();
        $fontStyle = new Font();
        $fontStyle->setSize($fontSize);
        $textRun_member_extension_name->addText($memExtensionName, $fontStyle);
        $templateProcessor->setComplexValue('member_extension_name', $textRun_member_extension_name);

        // Mother First Name
        $motherFirstName = $patient->mother_first_name ?? '';
        $fontSize = 12; // Default size
        $length = strlen($motherFirstName);
        if ($length > 20) {
            $fontSize = 12;
        }
        if ($length > 30) {
            $fontSize = 9;
        }
        if ($length > 40) {
            $fontSize = 8; // Minimum size
        }
        $textRun_mother_first_name = new TextRun();
        $fontStyle = new Font();
        $fontStyle->setSize($fontSize);
        $textRun_mother_first_name->addText($motherFirstName, $fontStyle);
        $templateProcessor->setComplexValue('mother_first_name', $textRun_mother_first_name);

        // Mother Middle Name
        $motherMiddleName = $patient->mother_middle_name ?? '';
        $fontSize = 12; // Default size
        $length = strlen($motherMiddleName);
        if ($length > 20) {
            $fontSize = 12;
        }
        if ($length > 30) {
            $fontSize = 9;
        }
        if ($length > 40) {
            $fontSize = 8; // Minimum size
        }
        $textRun_mother_middle_name = new TextRun();
        $fontStyle = new Font();
        $fontStyle->setSize($fontSize);
        $textRun_mother_middle_name->addText($motherMiddleName, $fontStyle);
        $templateProcessor->setComplexValue('mother_middle_name', $textRun_mother_middle_name);

        // Mother Last Name
        $motherLastName = $patient->mother_last_name ?? '';
        $fontSize = 12; // Default size
        $length = strlen($motherLastName);
        if ($length > 20) {
            $fontSize = 12;
        }
        if ($length > 30) {
            $fontSize = 9;
        }
        if ($length > 40) {
            $fontSize = 8; // Minimum size
        }
        $textRun_mother_last_name = new TextRun();
        $fontStyle = new Font();
        $fontStyle->setSize($fontSize);
        $textRun_mother_last_name->addText($motherLastName, $fontStyle);
        $templateProcessor->setComplexValue('mother_last_name', $textRun_mother_last_name);

        // Mother Extension Name
        $motherExtensionName = $patient->mother_extension_name ?? '';
        $fontSize = 12; // Default size
        $length = strlen($motherExtensionName);
        if ($length > 5) {
            $fontSize = 10;
        }
        if ($length > 10) {
            $fontSize = 8;
        }
        if ($length > 15) {
            $fontSize = 6; // Minimum size
        }
        $textRun_mother_extension_name = new TextRun();
        $fontStyle = new Font();
        $fontStyle->setSize($fontSize);
        $textRun_mother_extension_name->addText($motherExtensionName, $fontStyle);
        $templateProcessor->setComplexValue('mother_extension_name', $textRun_mother_extension_name);

        // Spouse First Name
        $spouseFirstName = $patient->spouse_first_name ?? '';
        $fontSize = 12; // Default size
        $length = strlen($spouseFirstName);
        if ($length > 20) {
            $fontSize = 12;
        }
        if ($length > 30) {
            $fontSize = 9;
        }
        if ($length > 40) {
            $fontSize = 8; // Minimum size
        }
        $textRun_spouse_first_name = new TextRun();
        $fontStyle = new Font();
        $fontStyle->setSize($fontSize);
        $textRun_spouse_first_name->addText($spouseFirstName, $fontStyle);
        $templateProcessor->setComplexValue('spouse_first_name', $textRun_spouse_first_name);

        // Spouse Middle Name
        $spouseMiddleName = $patient->spouse_middle_name ?? '';
        $fontSize = 12; // Default size
        $length = strlen($spouseMiddleName);
        if ($length > 20) {
            $fontSize = 12;
        }
        if ($length > 30) {
            $fontSize = 9;
        }
        if ($length > 40) {
            $fontSize = 8; // Minimum size
        }
        $textRun_spouse_middle_name = new TextRun();
        $fontStyle = new Font();
        $fontStyle->setSize($fontSize);
        $textRun_spouse_middle_name->addText($spouseMiddleName, $fontStyle);
        $templateProcessor->setComplexValue('spouse_middle_name', $textRun_spouse_middle_name);

        // Spouse Last Name
        $spouseLastName = $patient->spouse_last_name ?? '';
        $fontSize = 12; // Default size
        $length = strlen($spouseLastName);
        if ($length > 20) {
            $fontSize = 12;
        }
        if ($length > 30) {
            $fontSize = 9;
        }
        if ($length > 40) {
            $fontSize = 8; // Minimum size
        }
        $textRun_spouse_last_name = new TextRun();
        $fontStyle = new Font();
        $fontStyle->setSize($fontSize);
        $textRun_spouse_last_name->addText($spouseLastName, $fontStyle);
        $templateProcessor->setComplexValue('spouse_last_name', $textRun_spouse_last_name);

        // Spouse Extension Name
        $spouseExtensionName = $patient->spouse_extension_name ?? '';
        $fontSize = 12; // Default size
        $length = strlen($spouseExtensionName);
        if ($length > 5) {
            $fontSize = 10;
        }
        if ($length > 10) {
            $fontSize = 8;
        }
        if ($length > 15) {
            $fontSize = 6; // Minimum size
        }
        $textRun_spouse_extension_name = new TextRun();
        $fontStyle = new Font();
        $fontStyle->setSize($fontSize);
        $textRun_spouse_extension_name->addText($spouseExtensionName, $fontStyle);
        $templateProcessor->setComplexValue('spouse_extension_name', $textRun_spouse_extension_name);

        // Member Mononym
        if ($patient->member_mononym == 1) {
            $templateProcessor->setValue('member_mononym', '✓'); // Insert checkmark
        } else {
            $templateProcessor->setValue('member_mononym', ''); // Leave empty
        }

        // Member Last Name
        if (empty($patient->member_last_name)) {
            $templateProcessor->setValue('no_member_last_name', '✓'); // Insert checkmark
        } else {
            $templateProcessor->setValue('no_member_last_name', ''); // Insert last name
        }

        // Mother Mononym
        if ($patient->mother_mononym == 1) {
            $templateProcessor->setValue('mother_mononym', '✓'); // Insert checkmark
        } else {
            $templateProcessor->setValue('mother_mononym', ''); // Leave empty
        }

        // Mother Last Name
        if (empty($patient->mother_last_name)) {
            $templateProcessor->setValue('mother_last_name', '✓'); // Insert checkmark
        } else {
            $templateProcessor->setValue('mother_last_name', $patient->mother_last_name); // Insert last name
        }

        // Spouse Mononym
        if ($patient->spouse_mononym == 1) {
            $templateProcessor->setValue('spouse_mononym', '✓'); // Insert checkmark
        } else {
            $templateProcessor->setValue('spouse_mononym', ''); // Leave empty
        }

        // Spouse Last Name
        if (empty($patient->spouse_last_name)) {
            $templateProcessor->setValue('spouse_last_name', '✓'); // Insert checkmark
        } else {
            $templateProcessor->setValue('spouse_last_name', $patient->spouse_last_name); // Insert last name
        }



        $templateProcessor->setValue('member_birthdate', $patient->date_of_birth->format('m/d/Y'));
        $templateProcessor->setValue('member_philhealth_id', $patient->philhealth_id);
        $templateProcessor->setValue('member_address', $patient->address);
        $templateProcessor->setValue('member_contact_number', $patient->contact_number ?? 'N/A');
        $templateProcessor->setValue('member_citizenship', $patient->citizenship);
        $templateProcessor->setValue('member_sex', $patient->sex);
        $templateProcessor->setValue('member_civil_status', $patient->civil_status);
        
        // Replace admission and discharge dates
        $templateProcessor->setValue('admission_date', $patient->admission_date ? $patient->admission_date->format('m/d/Y') : 'N/A');
        $templateProcessor->setValue('discharge_date', $patient->discharge_date ? $patient->discharge_date->format('m/d/Y') : 'N/A');
    
        // Replace reason/purpose and status
        $templateProcessor->setValue('reason_or_purpose', $patient->reason_or_purpose ?? 'N/A');
        $templateProcessor->setValue('status', $patient->status ?? 'N/A');
    
        // Handle dependents (Up to 4)
        for ($i = 1; $i <= 4; $i++) {
            if (isset($patient->dependents[$i - 1])) {
                $dependent = $patient->dependents[$i - 1];
                $templateProcessor->setValue("dependent_{$i}_first_name", $dependent->dependent_first_name ?? 'N/A');
                $templateProcessor->setValue("dependent_{$i}_middle_name", $dependent->dependent_middle_name ?? 'N/A');
                $templateProcessor->setValue("dependent_{$i}_last_name", $dependent->dependent_last_name ?? 'N/A');
                $templateProcessor->setValue("dependent_{$i}_extension_name", $dependent->dependent_extension_name ?? 'N/A');
                $templateProcessor->setValue("dependent_{$i}_relationship", $dependent->dependent_relationship ?? 'N/A');
                $templateProcessor->setValue("dependent_{$i}_birthdate", $dependent->dependent_date_of_birth ? $dependent->dependent_date_of_birth->format('m/d/Y') : 'N/A');
                $templateProcessor->setValue("dependent_{$i}_philhealth_id", $dependent->philhealth_id_2 ?? 'N/A');
                $templateProcessor->setValue("dependent_{$i}_admission_date", $dependent->admission_date_2 ? $dependent->admission_date_2->format('m/d/Y') : 'N/A');
                $templateProcessor->setValue("dependent_{$i}_discharge_date", $dependent->discharge_date_2 ? $dependent->discharge_date_2->format('m/d/Y') : 'N/A');
                $templateProcessor->setValue("dependent_{$i}_status", $dependent->status_2 ?? 'N/A');
                $templateProcessor->setValue("dependent_{$i}_reason_or_purpose", $dependent->reason_or_purpose2 ?? 'N/A');
            } else {
                // If no dependent available, set default values
                $templateProcessor->setValue("dependent_{$i}_first_name", 'N/A');
                $templateProcessor->setValue("dependent_{$i}_middle_name", 'N/A');
                $templateProcessor->setValue("dependent_{$i}_last_name", 'N/A');
                $templateProcessor->setValue("dependent_{$i}_extension_name", 'N/A');
                $templateProcessor->setValue("dependent_{$i}_relationship", 'N/A');
                $templateProcessor->setValue("dependent_{$i}_birthdate", 'N/A');
                $templateProcessor->setValue("dependent_{$i}_philhealth_id", 'N/A');
                $templateProcessor->setValue("dependent_{$i}_admission_date", 'N/A');
                $templateProcessor->setValue("dependent_{$i}_discharge_date", 'N/A');
                $templateProcessor->setValue("dependent_{$i}_status", 'N/A');
                $templateProcessor->setValue("dependent_{$i}_reason_or_purpose", 'N/A');
            }
        }
        
        // Save generated document
        $outputPath = storage_path("app/generated_docs/pmrf_{$health_record_id}.docx");
        $templateProcessor->saveAs($outputPath);
        
        return response()->download($outputPath)->deleteFileAfterSend(true);
    }
    
    public function exportTransmittal(Request $request)
    {
        Log::info('Export Transmittal method started.');
    
        try {
            // Get input values from the request
            $transmittalId = $request->input('transmittal_id');
            Log::info("Generated Transmittal ID: $transmittalId");
    
            $position = $request->input('position');
            $preparedBy = $request->input('prepared_by');
            Log::info("Position: $position, Prepared By: $preparedBy");
    
            // Decode the table data from JSON.
            // It may be in one of two formats: either a top-level key "data" or an array directly.
            $decodedData = json_decode($request->input('tableData'), true);
            Log::info('Raw Table Data:', ['data' => $decodedData]);
    
            // Determine the actual rows.
            if (isset($decodedData['data'])) {
                $rawRows = $decodedData['data'];
            } else {
                $rawRows = $decodedData;
            }
    
            if (empty($rawRows)) {
                Log::warning('No data available to export.');
                return response()->json(['error' => 'No data available to export.'], 400);
            }
            Log::info('Data decoded successfully, number of rows: ' . count($rawRows));
    
            // Collect health record and dependent hospital IDs from the raw rows.
            $healthRecordIds = [];
            $dependentHospitalIds = [];
            foreach ($rawRows as $row) {
                if (!empty($row['health_record_id'])) {
                    $healthRecordIds[] = $row['health_record_id'];
                }
                if (!empty($row['dependent_hospital_id'])) {
                    $dependentHospitalIds[] = $row['dependent_hospital_id'];
                }
            }
            Log::info('Collected Health Record IDs:', ['ids' => array_unique($healthRecordIds)]);
            Log::info('Collected Dependent Hospital IDs:', ['ids' => array_unique($dependentHospitalIds)]);
    
            // Sanitize input data and remove sensitive keys.
            // We expect each row to have a "cells" key containing the exportable data.
            $exportData = array_map(function ($row) {
                // Remove the IDs so they are not included in the export.
                unset($row['health_record_id'], $row['dependent_hospital_id']);
                // Sanitize the cells if they exist.
                if (isset($row['cells']) && is_array($row['cells'])) {
                    return array_map(function ($cell) {
                        return is_string($cell) ? preg_replace('/\s+/', ' ', trim($cell)) : $cell;
                    }, $row['cells']);
                }
                // If "cells" is not set, assume the row is already in exportable format.
                return $row;
            }, $rawRows);
    
            // Use reset() to preview the first row without assuming numeric keys.
            $firstRow = reset($exportData);
            Log::info('Cleaned export data preview:', ['data' => json_encode($firstRow)]);
            Log::info('Full Request Data:', $request->all());
    
            // Additional form data
            $datePrepared = now()->toDateString();
            $numberOfClaims = count($exportData);
            $issuedBy = auth()->id();
            Log::info('Transmittal Data:', [
                'Transmittal ID'   => $transmittalId,
                'Prepared By'      => $preparedBy,
                'Position'         => $position,
                'Date Prepared'    => $datePrepared,
                'Number of Claims' => $numberOfClaims,
                'Issued By'        => $issuedBy,
                'Export Data'      => $exportData,
            ]);
    
            // Generate file name for the export
            $fileName = 'transmittal_' . time() . '.xlsx';
            Log::info("Generated File Name: $fileName");
    
            // Instantiate and store the Excel export file using the export data.
            $export = new \App\Exports\TransmittalExport(
                $exportData,
                $transmittalId,
                $datePrepared,
                $preparedBy,
                $position,
                $numberOfClaims,
                $issuedBy
            );
            Log::info('TransmittalExport class instantiated.');
            $filePath = \Maatwebsite\Excel\Facades\Excel::store($export, $fileName, 'public');
            Log::info("File stored at: $filePath");
    
            // Retrieve file contents and convert to base64 blob if needed.
            $fileContents = \Illuminate\Support\Facades\Storage::disk('public')->get($fileName);
            Log::info("File contents retrieved.");
            $blob = base64_encode($fileContents);
            Log::info("File converted to base64 blob.");
    
            // Update archive locks and set transmittal IDs using the collected IDs.
            if (!empty($healthRecordIds)) {
                \App\Models\PosPatient::whereIn('health_record_id', array_unique($healthRecordIds))
                    ->update([
                        'archive_lock_1'   => 1,
                        'transmittal_id_1' => $transmittalId
                    ]);
                Log::info('Updated archive_lock_1 and transmittal_id_1 for patients.');
            }
    
            if (!empty($dependentHospitalIds)) {
                \App\Models\PosPatientDependant::whereIn('dependent_hospital_id', array_unique($dependentHospitalIds))
                    ->update([
                        'archive_lock_2'   => 1,
                        'transmittal_id_2' => $transmittalId
                    ]);
                Log::info('Updated archive_lock_2 and transmittal_id_2 for dependents.');
            }
    
            Log::info("Transmittal record inserted into database.");
    
            // Return the file for download.
            return \Illuminate\Support\Facades\Storage::disk('public')->download($fileName);
    
        } catch (\Exception $e) {
            Log::error('Error in exportTransmittal: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong during export.'], 500);
        }
    }
    
    
    
    
    
    

    
    /**
     * Redirect to the patient management page.
     */
    public function redirectToPatients()
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
                'pos_patients_dependants.archive_lock_2' // For members with dependents
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
                    return $patient->archive_lock_1 == 0;
                } else {
                    // Has dependents – filter dependents to include only those with archive_lock_2 equal to 1
                    $patient->dependents = $patient->dependents->filter(function ($dependent) {
                        return $dependent->archive_lock_2 == 0;
                    });
                    // Only show this patient if there's at least one dependent with archive_lock_2 equals 1
                    return $patient->dependents->isNotEmpty();
                }
            });
        return view('admin.patient_admin', compact('patients'));
    }
    
    public function updatePatientDetails(Request $request, PosPatient $patient)
    {
        DB::beginTransaction();
        Log::info('Starting updatePatientDetails process for patient ID: ' . $patient->id);
    
        try {
            // Log raw request data
            Log::info('Raw Request Data:', $request->all());
    
            // Validate patient data
            Log::info('Validating patient data...');
            $validated = $this->validatePatientData($request);
            Log::info('Patient data validated successfully', $validated);
    
            // Update main patient record
            Log::info('Updating patient record for ID: ' . $patient->id);
            $this->updatePatientRecord($patient, $validated);
            Log::info('Patient record updated successfully');
    
            // Process dependents
            Log::info('Processing dependents for patient ID: ' . $patient->id);
            $this->processDependents($request, $patient);
            Log::info('Dependents processed successfully');
    
            DB::commit();
            Log::info('Transaction committed successfully for patient ID: ' . $patient->id);
    
            // Set a flash message and redirect to admin.patient_admin
            session()->flash('success', 'Patient details updated successfully');
            return redirect()->route('admin.patient_admin');
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            Log::error('Validation failed', ['errors' => $e->errors()]);
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Update failed', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Update failed: ' . $e->getMessage()], 500);
        }
    }
    
    private function validatePatientData(Request $request)
    {
        $validated = $request->validate([
            // Patient Details
            'health_record_id'       => 'required|string|max:255',
            'philhealth_id'          => 'required|string|max:255',
            'purpose'                => 'required|in:Registration,Updating/Amendment',
            'provider_konsulta'      => 'nullable|string|max:255',
            'admission_date'         => 'nullable|date',
            'discharge_date'         => 'nullable|date',
            'reason_or_purpose'      => 'nullable|string|max:255',
            'status'                 => 'nullable|string|max:255',
            // Note: attachment_type_1 and attachment_type_2 are not processed here.
        
            // File upload for patient (max 10MB)
            'attachment_1'           => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
    
            // Personal Information
            'member_first_name'      => 'required|string|max:255',
            'member_middle_name'     => 'nullable|string|max:255',
            'member_last_name'       => 'required|string|max:255',
            'member_extension_name'  => 'nullable|string|max:255',
            'member_mononym'         => 'nullable|boolean',
            'mother_first_name'      => 'nullable|string|max:255',
            'mother_middle_name'     => 'nullable|string|max:255',
            'mother_last_name'       => 'nullable|string|max:255',
            'mother_extension_name'  => 'nullable|string|max:255',
            'mother_mononym'         => 'nullable|boolean',
            'spouse_first_name'      => 'nullable|string|max:255',
            'spouse_middle_name'     => 'nullable|string|max:255',
            'spouse_last_name'       => 'nullable|string|max:255',
            'spouse_extension_name'  => 'nullable|string|max:255',
            'spouse_mononym'         => 'nullable|boolean',
            'date_of_birth'          => 'required|date',
            'place_of_birth'         => 'required|string|max:255',
            'sex'                    => 'required|in:Male,Female',
            'civil_status'           => 'required|in:Single,Married,Annulled,Widower,Legally Separated',
            'citizenship'            => 'required|in:Filipino,Foreign National,Dual Citizen',
            'philsys_id'             => 'nullable|string|max:255',
            'tax_payer_id'           => 'nullable|string|max:255',
    
            // Contact and Address Information
            'address'                => 'required|string|max:255',
            'contact_number'         => 'nullable|string|max:255',
            'home_phone_number'      => 'nullable|string|max:255',
            'business_direct_line'   => 'nullable|string|max:255',
            'email_address'          => 'nullable|email|max:255',
            'mailing_address'        => 'nullable|string|max:255',
    
            // Dependents
            'dependents'             => 'nullable|array',
            'dependents.*.dependent_hospital_id' => 'nullable|integer|exists:pos_patients_dependants,dependent_hospital_id',
            'dependents.*.dependent_first_name'  => 'nullable|string|max:255',
            'dependents.*.dependent_middle_name' => 'nullable|string|max:255',
            'dependents.*.dependent_last_name'   => 'nullable|string|max:255',
            'dependents.*.dependent_extension_name' => 'nullable|string|max:255',
            'dependents.*.dependent_relationship'   => 'nullable|string|max:255',
            'dependents.*.dependent_date_of_birth'  => 'nullable|date',
            'dependents.*.dependent_mononym'     => 'nullable|boolean',
            'dependents.*.permanent_disability'  => 'nullable|boolean',
            // File upload for dependent (max 10MB)
            'dependents.*.attachment_2'          => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'dependents.*.admission_date_2'      => 'nullable|date',
            'dependents.*.discharge_date_2'      => 'nullable|date',
            'dependents.*.status_2'              => 'nullable|string|max:255',
            'dependents.*.reason_or_purpose2'    => 'nullable|string|max:255',
        ]);
    
        foreach ($validated as $key => $value) {
            if (is_string($value) && !mb_check_encoding($value, 'UTF-8')) {
                Log::error("Encoding issue detected in field: {$key}");
            }
        }
    
        return $validated;
    }
    
    private function updatePatientRecord(PosPatient $patient, array $validated)
    {
        // Check each field for proper UTF-8 encoding.
        foreach ($validated as $key => $value) {
            if (is_string($value) && !mb_check_encoding($value, 'UTF-8')) {
                Log::error("Database encoding issue in: {$key}");
            }
        }
        
        // Process file upload for attachment_1 if a new file is provided.
        if (request()->hasFile("attachment_1")) {
            $file = request()->file("attachment_1");
            if ($file->isValid()) {
                \Log::info("Found valid file for attachment_1:", ['filename' => $file->getClientOriginalName()]);
                
                // Read the file's binary content and assign it to attachment_1.
                $validated['attachment_1'] = file_get_contents($file->getRealPath());
            } else {
                \Log::warning("Invalid file for attachment_1.");
                // If the file is invalid, do not update the attachment.
                unset($validated['attachment_1']);
            }
        } else {
            \Log::info("No new file uploaded for attachment_1.");
            // If no file is uploaded, remove the key so the existing value remains unchanged.
            unset($validated['attachment_1']);
        }
        
        // Fill the patient model with the validated data.
        $patient->fill($validated);
        
        // Save the model only if changes were made.
        if ($patient->isDirty()) {
            $patient->save();
        }
    }
    
    private function processDependents(Request $request, PosPatient $patient)
    {
        // Retrieve dependents data; default to an empty array if not provided.
        $dependentsData = $request->input('dependents', []);
        
        // If the member has no dependents, log and exit.
        if (empty($dependentsData)) {
            \Log::info("No dependents provided for patient ID: " . $patient->health_record_id);
            return;
        }
    
        \Log::info("Dependents data from request:", $dependentsData);
    
        // Process each dependent
        foreach ($dependentsData as $index => $dependentData) {
            // Ensure we have a valid dependent identifier.
            if (!empty($dependentData['dependent_hospital_id'])) {
                \Log::info("Processing dependent index {$index} with dependent_hospital_id: " . $dependentData['dependent_hospital_id']);
                
                // Find the existing dependent record for this patient.
                $dependent = PosPatientDependant::where('dependent_hospital_id', $dependentData['dependent_hospital_id'])
                    ->where('health_record_id_relation_2', $patient->health_record_id)
                    ->first();
    
                if ($dependent) {
                    \Log::info("Found dependent record:", $dependent->toArray());
    
                    // Process file upload for attachment_2 if a new file is provided.
                    if ($request->hasFile("dependents.{$index}.attachment_2")) {
                        $depFile = $request->file("dependents.{$index}.attachment_2");
                        if ($depFile->isValid()) {
                            \Log::info("Found valid file for dependent index {$index}:", ['filename' => $depFile->getClientOriginalName()]);
                            
                            // Read the file's binary content and assign it to attachment_2.
                            $binaryData = file_get_contents($depFile->getRealPath());
                            $dependentData['attachment_2'] = $binaryData;
                        } else {
                            \Log::warning("Invalid file for dependent index {$index}.");
                            unset($dependentData['attachment_2']);
                        }
                    } else {
                        \Log::info("No new file uploaded for dependent index {$index}.");
                        unset($dependentData['attachment_2']);
                    }
    
                    \Log::info("Updating dependent index {$index} with data:", $dependentData);
                    $dependent->fill($dependentData);
    
                    if ($dependent->isDirty()) {
                        $dependent->save();
                        \Log::info("Dependent updated successfully.");
                    } else {
                        \Log::info("No changes detected for dependent index {$index}.");
                    }
                } else {
                    \Log::warning("Dependent not found for update with dependent_hospital_id: " . $dependentData['dependent_hospital_id']);
                }
            } else {
                \Log::info("Skipping dependent index {$index} with missing dependent_hospital_id.");
            }
        }
    }
    
    public function deletePatient(Request $request, $id)
    {
        \Log::info("Attempting to delete patient with ID: $id");
        // Find the patient (member) with dependents loaded.
        $patient = PosPatient::with('dependents')->findOrFail($id);
        $dependentCount = $patient->dependents->count();
        \Log::info("Found patient with health_record_id: {$patient->health_record_id} having {$dependentCount} dependent(s).");
        // If no dependent_id is provided:
        if ($dependentCount <= 1) {
            \Log::info("Dependent count is 0 or 1. Proceeding with deletion of the member and all dependents.");
            if ($dependentCount == 1) {
                $soleDependent = $patient->dependents->first();
                \Log::info("Deleting sole dependent: " . json_encode($soleDependent->toArray()));
            }
            // Delete all dependents (if any) then the patient record.
            $patient->dependents()->delete();
            \Log::info("All dependents deleted for patient with health_record_id: {$patient->health_record_id}.");
            $patient->delete();
            \Log::info("Patient with health_record_id: {$patient->health_record_id} deleted successfully.");
            return redirect()->back()->with('success', 'Member and their dependents (if any) deleted successfully.');
        }
    
        // If a dependent_id is provided, delete only that specific dependent.
        if ($request->has('dependent_id')) {
            $dependentId = $request->dependent_id;
            \Log::info("Request includes dependent_id: $dependentId. Proceeding with deletion of the specified dependent.");
            
            // Query using dependent_hospital_id instead of the model's primary key
            $dependent = PosPatientDependant::where('dependent_hospital_id', $dependentId)->firstOrFail();
            \Log::info("Dependent details: " . json_encode($dependent->toArray()));
            \Log::info("Deleting dependent: " . strtoupper($dependent->dependent_first_name) . " " . strtoupper($dependent->dependent_last_name) . " (ID: $dependentId)");
            $dependent->delete();
            \Log::info("Dependent with dependent_hospital_id $dependentId deleted successfully.");
            return redirect()->back()->with('success', 'Dependent deleted successfully, member retained.');
        }

    
    

    }

    public function addDependent(Request $request)
    {
        Log::info('Incoming request data:', $request->all());
    
        try {
            // Validate request data
            $validatedData = $request->validate([
                'health_record_id_relation_2' => 'required|exists:pos_patients,health_record_id',
                'status_2'                    => 'required|string|max:255',
                'admission_date_2'            => 'required|date',
                'discharge_date_2'            => 'nullable|date|after_or_equal:admission_date_2',
                'reason_or_purpose2'          => 'required|string|max:500',
                'dependent_first_name'        => 'required|string|max:255',
                'dependent_middle_name'       => 'nullable|string|max:255',
                'dependent_last_name'         => 'required|string|max:255',
                'dependent_name_extension'    => 'nullable|string|max:10',
                'dependent_citizenship'       => 'required|string|max:100',
                'dependent_relationship'      => 'required|string|max:100',
                'dependent_date_of_birth'     => 'required|date|before:today',
                'attachment_type_2'           => 'required|string|max:100',
                'attachment_2'                => 'required|file|max:10240', // Max 10MB
            ]);
    
            // Handle file upload and store as blob
            if ($request->hasFile('attachment_2')) {
                $file = $request->file('attachment_2');
                $fileContent = file_get_contents($file->getRealPath());
                $validatedData['attachment_2'] = $fileContent;
    
                Log::info('File uploaded successfully', ['file_name' => $file->getClientOriginalName()]);
            }
    
            // Create a new dependent record
            $dependent = new PosPatientDependant();
            $dependent->fill($validatedData); // Fill attributes
            $saveSuccess = $dependent->save(); // Save and check result
    
            if (!$saveSuccess) {
                Log::error('Failed to save dependent record.');
                return response()->json(['error' => 'Failed to add dependent.'], 500);
            }
    
            // Mark the form as submitted in session
            $request->session()->put('form_submitted', true);
    
            Log::info('Dependent added successfully', ['dependent_id' => $dependent->id]);
    
            return response()->json(['message' => 'Dependent added successfully!'], 200);
        } catch (\Exception $e) {
            // Log error with stack trace
            Log::error('Error adding dependent', [
                'message' => $e->getMessage(),
                'trace'   => $e->getTraceAsString(),
            ]);
    
            return response()->json(['error' => 'Failed to add dependent.'], 500);
        }
    }
    
    public function getDependents(Request $request)
    {
        // Validate that the patient ID is provided and exists in the pos_patients table
        $validated = $request->validate([
            'patient_id' => 'required|exists:pos_patients,health_record_id', // Ensure valid patient ID
        ]);

        // Log the start of the process
        Log::info('Fetching member and dependents started.', ['request_data' => $request->all()]);

        // Fetch the member using the health_record_id
        $member = PosPatient::find($validated['patient_id']);

        // Log member fetched successfully
        Log::info('Member found.', [
            'member_id' => $member->health_record_id,
            'name' => $member->member_first_name . ' ' . $member->member_last_name
        ]);

        // If the member is not found, return a 404 error
        if (!$member) {
            Log::error('Member not found.', ['patient_id' => $validated['patient_id']]);
            return response()->json(['error' => 'Member not found'], 404);
        }

        // Fetch all dependents related to this member (health_record_id_relation_2)
        $dependents = PosPatientDependant::where('health_record_id_relation_2', $validated['patient_id'])
            ->get([
                'dependent_first_name',
                'dependent_middle_name',
                'dependent_last_name',
                'dependent_extension_name',
                'dependent_relationship',
                'dependent_date_of_birth',
                'status_2'
            ]);

        // Log dependents fetched successfully
        Log::info('Dependents fetched.', ['dependents_count' => $dependents->count()]);

        // Prepare the response data for the member and their dependents
        return response()->json([
            'member' => [
                'health_record_id' => $member->health_record_id,
                'member_first_name' => $member->member_first_name,
                'member_middle_name' => $member->member_middle_name,  // Optional
                'member_last_name' => $member->member_last_name,
                'member_extension_name' => $member->member_extension_name,  // Optional
                'date_of_birth' => $member->date_of_birth,
                'place_of_birth' => $member->place_of_birth,
                'sex' => $member->sex,
                'civil_status' => $member->civil_status,
                'citizenship' => $member->citizenship,
                'address' => $member->address,
                'contact_number' => $member->contact_number,
                'email_address' => $member->email_address,
                'status' => $member->status,
            ],
            'dependents' => $dependents->map(function ($dependent) {
                return [
                    'dependent_first_name' => $dependent->dependent_first_name,
                    'dependent_middle_name' => $dependent->dependent_middle_name,  // Optional
                    'dependent_last_name' => $dependent->dependent_last_name,
                    'dependent_extension_name' => $dependent->dependent_extension_name,  // Optional
                    'dependent_relationship' => $dependent->dependent_relationship,
                    'dependent_date_of_birth' => $dependent->dependent_date_of_birth,
                    'status_2' => $dependent->status_2,
                ];
            })
        ]);
    }
    
    
    
    
    
    
    
    
    

    public function getPatientDetails($id)
    {
        // Log the attempt to fetch a patient by ID
        \Log::info('Fetching patient details for ID: ' . $id);
    
        $patient = PosPatient::find($id);
    
        if (!$patient) {
            \Log::error('Patient not found for ID: ' . $id);
            return response()->json(['error' => 'Patient not found'], 404);
        }
    
        \Log::info('Patient found', ['health_record_id' => $patient->health_record_id]);
    
        // Ensure the relationship "dependents" is defined in the PosPatient model
        $dependents = $patient->dependents;
        \Log::info('Number of dependents found: ' . count($dependents));
    
        $dependentData = [];
        foreach ($dependents as $dependent) {
            $dependentData[] = [
                'dependent_hospital_id'     => $dependent->dependent_hospital_id,
                'dependent_first_name'      => $dependent->dependent_first_name,
                'dependent_middle_name'     => $dependent->dependent_middle_name,
                'dependent_last_name'       => $dependent->dependent_last_name,
                'dependent_extension_name'  => $dependent->dependent_extension_name,
                'dependent_relationship'    => $dependent->dependent_relationship,
                'dependent_date_of_birth'   => $dependent->dependent_date_of_birth,
                'dependent_mononym'         => $dependent->dependent_mononym,
                'permanent_disability'      => $dependent->permanent_disability,
                'attachment_type_2'         => $dependent->attachment_type_2,
                // Generate a data URL for attachment_2 if a blob exists.
                'attachment_2'          => $dependent->attachment_2 
                                                    ? 'data:' . $dependent->attachment_type_2 . ';base64,' . base64_encode($dependent->attachment_2)
                                                    : null,
                'attachment_type_2'         => $dependent->attachment_type_2,
                'admission_date_2'          => $dependent->admission_date_2,
                'discharge_date_2'          => $dependent->discharge_date_2,
                'status_2'                  => $dependent->status_2,
                'reason_or_purpose2'        => $dependent->reason_or_purpose2,
            ];
        }
    
        $responseData = [
            // **Patient Details**
            'health_record_id'      => $patient->health_record_id,
            'philhealth_id'         => $patient->philhealth_id,
            'purpose'               => $patient->purpose,
            'provider_konsulta'     => $patient->provider_konsulta,
            
            // Member Information
            'member_first_name'     => $patient->member_first_name,
            'member_middle_name'    => $patient->member_middle_name,
            'member_last_name'      => $patient->member_last_name,
            'member_extension_name' => $patient->member_extension_name,
            'member_mononym'        => $patient->member_mononym,
            
            // Mother's Information
            'mother_first_name'     => $patient->mother_first_name,
            'mother_middle_name'    => $patient->mother_middle_name,
            'mother_last_name'      => $patient->mother_last_name,
            'mother_extension_name' => $patient->mother_extension_name,
            'mother_mononym'        => $patient->mother_mononym,
            
            // Spouse's Information
            'spouse_first_name'     => $patient->spouse_first_name,
            'spouse_middle_name'    => $patient->spouse_middle_name,
            'spouse_last_name'      => $patient->spouse_last_name,
            'spouse_extension_name' => $patient->spouse_extension_name,
            'spouse_mononym'        => $patient->spouse_mononym,
            
            // Other Personal Details
            'date_of_birth'         => $patient->date_of_birth,
            'place_of_birth'        => $patient->place_of_birth,
            'sex'                   => $patient->sex,
            'civil_status'          => $patient->civil_status,
            'citizenship'           => $patient->citizenship,
            'philsys_id'            => $patient->philsys_id,
            'tax_payer_id'          => $patient->tax_payer_id,
            
            // Contact Information
            'address'               => $patient->address,
            'contact_number'        => $patient->contact_number,
            'home_phone_number'     => $patient->home_phone_number,
            'business_direct_line'  => $patient->business_direct_line,
            'email_address'         => $patient->email_address,
            'mailing_address'       => $patient->mailing_address,
            
            // Admission Details
            'admission_date'        => $patient->admission_date,
            'discharge_date'        => $patient->discharge_date,
            
            // Newly Added Fields (Patient Level)
            'reason_or_purpose'     => $patient->reason_or_purpose,
            'status'                => $patient->status,
            'attachment_type_1'     => $patient->attachment_type_1,
                    // New field: Generate a data URL for attachment_1 if it exists
            'attachment_1'      => $patient->attachment_1 
                ? 'data:' . $patient->attachment_type_1 . ';base64,' . base64_encode($patient->attachment_1)
                : null,
    
            // **Dependent Details**
            'dependents'            => $dependentData,
        ];
    
        \Log::info('Returning patient data', $responseData);
    
        return response()->json($responseData);
    }
    

    public function download($id, $attachment)
    {
        // Log the download request
        Log::info("Download requested", ['patient_id' => $id, 'attachment' => $attachment]);
    
        // Find the patient record by ID (assuming your model is called `PosPatient`)
        $patient = PosPatient::findOrFail($id);
    
        // Determine the attachment field name dynamically (attachment_1 or attachment_2)
        $attachmentField = 'attachment_' . $attachment; 
        $attachmentTypeField = 'attachment_type_' . $attachment;
    
        // Check if the attachment exists
        if ($patient->{$attachmentField}) {
            // Get the attachment content from the database
            $fileContent = $patient->{$attachmentField};
            $fileType = $patient->{$attachmentTypeField}; // Get the attachment type (like 'image/jpeg')
    
            // Generate the custom file name
            $fileName = $patient->{$attachmentTypeField} . '_' . $patient->health_record_id . '.png';
    
            // Log file details before download
            Log::info("Attachment found, preparing download", [
                'patient_id' => $id,
                'attachment_field' => $attachmentField,
                'file_type' => $fileType,
                'file_name' => $fileName,
            ]);
    
            // Return the binary data as a response with the correct content type and custom file name
            return response($fileContent)
                ->header('Content-Type', $fileType)
                ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
        } else {
            // Log the error if the attachment doesn't exist
            Log::warning("Attachment not found", [
                'patient_id' => $id,
                'attachment_field' => $attachmentField,
            ]);
    
            // Return an error response if the file doesn't exist
            return redirect()->back()->with('error', 'Attachment not found!');
        }
    }

    public function download_2($id, $attachment)
    {
        // Log the download request
        Log::info("Download requested", ['patient_id' => $id, 'attachment' => $attachment]);
    
        // Find the patient record by ID (assuming your model is called `PosPatient`)
        $patient = PosPatientDependant::findOrFail($id);
    
        // Determine the attachment field name dynamically (attachment_1 or attachment_2)
        $attachmentField = 'attachment_' . $attachment; 
        $attachmentTypeField = 'attachment_type_' . $attachment;
    
        // Check if the attachment exists
        if ($patient->{$attachmentField}) {
            // Get the attachment content from the database
            $fileContent = $patient->{$attachmentField};
            $fileType = $patient->{$attachmentTypeField}; // Get the attachment type (like 'image/jpeg')
    
            // Generate the custom file name
            $fileName = $patient->{$attachmentTypeField} . '_' . $patient->health_record_id . '.png';
    
            // Log file details before download
            Log::info("Attachment found, preparing download", [
                'patient_id' => $id,
                'attachment_field' => $attachmentField,
                'file_type' => $fileType,
                'file_name' => $fileName,
            ]);
    
            // Return the binary data as a response with the correct content type and custom file name
            return response($fileContent)
                ->header('Content-Type', $fileType)
                ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
        } else {
            // Log the error if the attachment doesn't exist
            Log::warning("Attachment not found", [
                'patient_id' => $id,
                'attachment_field' => $attachmentField,
            ]);
    
            // Return an error response if the file doesn't exist
            return redirect()->back()->with('error', 'Attachment not found!');
        }
    }
    
    
    
    /**
     * Store the patient and their dependents.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'philhealth_id' => 'required|unique:pos_patients',
            'purpose' => 'required',
            'member_first_name' => 'required',
            'member_last_name' => 'required',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required',
            'sex' => 'required|in:Male,Female',
            'civil_status' => 'required|in:Single,Married,Annulled,Widower,Legally Separated',
            'citizenship' => 'required|in:Filipino,Foreign National,Dual Citizen',
            'address' => 'required',
            // Validate dependents if provided
            'dependents' => 'nullable|array|max:4',
            'dependents.*.dependent_first_name' => 'required_with:dependents.*|string',
            'dependents.*.dependent_middle_name' => 'nullable|string',
            'dependents.*.reason_or_purpose2' => 'nullable|string',
            'dependents.*.dependent_last_name' => 'required_with:dependents.*|string',
            'dependents.*.dependent_extension_name' => 'nullable|string',
            'dependents.*.dependent_relationship' => 'required_with:dependents.*|string',
            'dependents.*.dependent_date_of_birth' => 'required_with:dependents.*|date',
            'dependents.*.dependent_mononym' => 'nullable|boolean',
            'dependents.*.permanent_disability' => 'nullable|boolean',
            'dependents.*.attachment_type_2' => 'nullable|string', // File type (if applicable)
            'dependents.*.attachment_2' => 'nullable|file|mimes:jpeg,png,pdf,doc,docx|max:2048', // Assuming it's a file
            'dependents.*.admission_date_2' => 'nullable|date',
            'dependents.*.discharge_date_2' => 'nullable|date|after_or_equal:dependents.*.admission_date_2',

        ]);
            
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Begin database transaction
        \DB::beginTransaction();

        try {
            // Store the primary PosPatient record
            $patient = PosPatient::create([
                'philhealth_id' => $request->philhealth_id,
                'purpose' => $request->purpose,
                'provider_konsulta' => $request->provider_konsulta,
                'member_first_name' => $request->member_first_name,
                'member_middle_name' => $request->member_middle_name,
                'member_last_name' => $request->member_last_name,
                'member_extension_name' => $request->member_extension_name,
                'member_mononym' => $request->member_mononym,
                'mother_first_name' => $request->mother_first_name,
                'mother_middle_name' => $request->mother_middle_name,
                'mother_last_name' => $request->mother_last_name,
                'mother_extension_name' => $request->mother_extension_name,
                'mother_mononym' => $request->mother_mononym,
                'spouse_first_name' => $request->spouse_first_name,
                'spouse_middle_name' => $request->spouse_middle_name,
                'spouse_last_name' => $request->spouse_last_name,
                'spouse_extension_name' => $request->spouse_extension_name,
                'spouse_mononym' => $request->spouse_mononym,
                'date_of_birth' => $request->date_of_birth,
                'place_of_birth' => $request->place_of_birth,
                'sex' => $request->sex,
                'civil_status' => $request->civil_status,
                'citizenship' => $request->citizenship,
                'philsys_id' => $request->philsys_id,
                'tax_payer_id' => $request->tax_payer_id,
                'address' => $request->address,
                'contact_number' => $request->contact_number,
                'home_phone_number' => $request->home_phone_number,
                'business_direct_line' => $request->business_direct_line,
                'email_address' => $request->email_address,
                'mailing_address' => $request->mailing_address,
                'admission_date' => $request->admission_date,
                'discharge_date' => $request->discharge_date,
                'reason_or_purpose' => $request->reason_or_purpose,
                'status' => $request->status,
                'attachment_type_1' => $request->attachment_type_1,
                'attachment_1' => $request->hasFile('attachment_1') ? file_get_contents($request->file('attachment_1')->getRealPath()) : null,
            ]);

                // Ensure 'dependents' exists and is an array
                if ($request->has('dependent_first_name') && is_array($request->dependent_first_name)) {
                    foreach ($request->dependent_first_name as $index => $firstName) {
                        // Only create a dependent record if the first name is not empty
                        if (!empty(trim($firstName))) {
                            PosPatientDependant::create([
                                'health_record_id_relation_2' => $patient->health_record_id,
                                'dependent_first_name'        => $firstName,
                                'dependent_middle_name'       => $request->dependent_middle_name[$index] ?? null,
                                'dependent_last_name'         => $request->dependent_last_name[$index] ?? null,
                                'dependent_extension_name'    => $request->dependent_name_extension[$index] ?? null,
                                'dependent_relationship'      => $request->dependent_relationship[$index] ?? null,
                                'dependent_date_of_birth'     => $request->dependent_dob[$index] ?? null,
                                'dependent_mononym'           => isset($request->dependent_mononym[$index]) ? 1 : 0,
                                'permanent_disability'        => isset($request->dependent_permanent_disability[$index]) ? 1 : 0,
                                'attachment_type_2'           => $request->attachment_type_2[$index] ?? null,
                                'attachment_2'                => $request->hasFile("attachment_2.$index") 
                                                                   ? file_get_contents($request->file("attachment_2.$index")->getRealPath()) 
                                                                   : null,
                                'admission_date_2'            => !empty($request->admission_date_2[$index]) ? $request->admission_date_2[$index] : null,
                                'discharge_date_2'            => !empty($request->discharge_date_2[$index]) ? $request->discharge_date_2[$index] : null,
                                'status_2'                    => $request->status_2[$index] ?? null,
                                'reason_or_purpose2'          => $request->reason_or_purpose2[$index] ?? null,
                            ]);
                        }
                    }
                }
            
            // Commit transaction
            \DB::commit();

            return redirect()->route('admin.patient_admin')->with('success', 'Patient and its dependent created successfully!');
        } catch (\Exception $e) {
            // Rollback transaction on error
            \DB::rollBack();
            return response()->json(['error' => 'An error occurred while saving the data.', 'message' => $e->getMessage()], 500);
        }
    }
}
