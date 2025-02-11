<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Log;

use App\Models\Transmittal;  // Import the Transmittal model

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

class AdminPatientController extends Controller
{

    public function exportTransmittal(Request $request)
    {
        Log::info('Export Transmittal method started.');
    
        try {
            $transmittalId = $request->input('transmittal_id');
            Log::info("Generated Transmittal ID: $transmittalId");
            $preparedBy = $request->input('prepared_by');
            // Decode the table data
            $tableData = json_decode($request->input('tableData'), true);
            Log::info('Raw Table Data: ', ['data' => $tableData]);
    
            if (empty($tableData)) {
                Log::warning('No data available to export.');
                return response()->json(['error' => 'No data available to export.'], 400);
            }
    
            Log::info('Data decoded successfully, number of rows: ' . count($tableData));
    
            // Sanitize input data
            $cleanedData = array_map(function ($row) {
                return array_map(function ($cell) {
                    return preg_replace('/\s+/', ' ', trim($cell));
                }, $row);
            }, $tableData);
    
            Log::info('Cleaned data preview: ' . json_encode($cleanedData[0]));
            Log::info('Request Data: ', $request->all());
    
            // Additional form data
            $transmittalId = $request->input('transmittal_id');
            $preparedBy = $request->input('prepared_by');
            $datePrepared = now()->toDateString();
            $numberOfClaims = count($cleanedData);
            $issuedBy = auth()->id();
                // Log all the variables
            Log::info('Transmittal Data:', [
                'Transmittal ID' => $transmittalId,
                'Prepared By' => $preparedBy,
                'Date Prepared' => $datePrepared,
                'Number of Claims' => $numberOfClaims,
                'Issued By' => $issuedBy,
                'Cleaned Data' => $cleanedData,  // If cleanedData is an array or object, you might want to use json_encode($cleanedData) for better readability
            ]);
    
            // Generate file name
            $fileName = 'transmittal_' . time() . '.xlsx';
            Log::info("Generated File Name: $fileName");
    
            // Export the Excel file
            $export = new TransmittalExport($cleanedData, $transmittalId, $datePrepared, $preparedBy, $numberOfClaims, $issuedBy);
            Log::info('TransmittalExport class instantiated.');
    
            $filePath = Excel::store($export, $fileName, 'public');
            Log::info("File stored at: $filePath");
    
            // Convert the file to a blob
            $fileContents = Storage::disk('public')->get($fileName);
            Log::info("File contents retrieved.");
    
            $blob = base64_encode($fileContents);
            Log::info("File converted to base64 blob.");
    
            // Store the transmittal record in the database using the model
            Transmittal::create([
                'transmittal_id' => $transmittalId,
                'attachment_transmittal' => $blob,
                'date_prepared' => $datePrepared,
                'prepared_by' => $preparedBy,
                'number_of_claims' => $numberOfClaims,
                'issued_by' => $issuedBy,
            ]);
            Log::info("Transmittal record inserted into database.");
    
            // Return the file for download
            return Storage::disk('public')->download($fileName);
    
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
            )
            ->get()
            ->groupBy('health_record_id') // Group by health_record_id to prevent duplicate rows for the same patient
            ->map(function ($group) {
                $patient = $group->first(); // Get the first patient in the group, which will have the member data
        
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
                    $patient->member_date_of_expiry = Carbon::parse($patient->admission_date)->addDays(61)->format('Y-m-d');
                    $patient->member_remaining_days = (int) max(0, Carbon::parse($patient->admission_date)->addDays(61)->diffInDays(Carbon::now()));
                    $patient->member_discharge_days = (int) max(0, Carbon::parse($patient->discharge_date)->addDays(61)->diffInDays(Carbon::now()));
                } else {
                    $patient->member_date_of_expiry = 'N/A';
                    $patient->member_remaining_days = 0;
                }
        
                // Group dependents and calculate expiry and remaining days for each dependent
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
                        $dependent->date_of_expiry = Carbon::parse($dependent->admission_date_2)->addDays(61)->format('Y-m-d');
                        $dependent->remaining_days = (int) max(0, Carbon::parse($dependent->admission_date_2)->addDays(61)->diffInDays(Carbon::now()));
                    } else {
                        $dependent->remaining_days = 0;
                    }

                    // Attachments for each dependent
                    if ($dependent->attachment_2) {
                        $dependent->attachment_link = route('patients.download', ['id' => $dependent->health_record_id, 'attachment' => 2]);
                        $dependent->attachment_type = $dependent->attachment_type_2;
                    } else {
                        $dependent->attachment_link = 'No Attachment';
                        $dependent->attachment_type = 'N/A';
                    }
    
                    return $dependent;
                });
        
                // Attach dependents to the patient
                $patient->dependents = $dependents;
        
                return $patient;
            });
    
        return view('admin.patient_admin', compact('patients'));
    }
    
    public function updatePatientDetails(Request $request, $id)
    {
        // Validate patient and dependent fields
        $validatedData = $request->validate([
            'philhealth_id'            => 'required|string|max:255',
            'purpose'                  => 'required|in:Registration,Updating/Amendment',
            'provider_konsulta'        => 'nullable|string',
            'member_first_name'        => 'required|string',
            'member_middle_name'       => 'nullable|string',
            'member_last_name'         => 'required|string',
            'member_extension_name'    => 'nullable|string',
            'member_mononym'           => 'nullable|boolean',
            'mother_first_name'        => 'nullable|string',
            'mother_middle_name'       => 'nullable|string',
            'mother_last_name'         => 'nullable|string',
            'mother_extension_name'    => 'nullable|string',
            'mother_mononym'           => 'nullable|boolean',
            'spouse_first_name'        => 'nullable|string',
            'spouse_middle_name'       => 'nullable|string',
            'spouse_last_name'         => 'nullable|string',
            'spouse_extension_name'    => 'nullable|string',
            'spouse_mononym'           => 'nullable|boolean',
            'date_of_birth'            => 'required|date',
            'place_of_birth'           => 'required|string',
            'sex'                      => 'required|in:Male,Female',
            'civil_status'             => 'required|in:Single,Married,Annulled,Widower,Legally Separated',
            'citizenship'              => 'required|in:Filipino,Foreign National,Dual Citizen',
            'philsys_id'               => 'nullable|numeric',
            'tax_payer_id'             => 'nullable|numeric',
            'address'                  => 'required|string',
            'contact_number'           => 'nullable|numeric',
            'home_phone_number'        => 'nullable|string',
            'business_direct_line'     => 'nullable|numeric',
            'email_address'            => 'nullable|email',
            'mailing_address'          => 'nullable|string',
            'admission_date'           => 'nullable|date',
            'discharge_date'           => 'nullable|date',
            'reason_or_purpose'        => 'nullable|string',
            'status'                   => 'nullable|string',
            'attachment_type_1'        => 'nullable|string',
    
            // Dependents (if any)
            'dependents'                         => 'nullable|array',
            'dependents.*.dependent_hospital_id'   => 'nullable|integer',
            'dependents.*.dependent_first_name'    => 'nullable|string',
            'dependents.*.dependent_middle_name'   => 'nullable|string',
            'dependents.*.dependent_last_name'     => 'nullable|string',
            'dependents.*.dependent_extension_name'=> 'nullable|string',
            'dependents.*.dependent_relationship'  => 'nullable|string',
            'dependents.*.dependent_date_of_birth' => 'nullable|date',
            'dependents.*.dependent_mononym'       => 'nullable|boolean',
            'dependents.*.permanent_disability'    => 'nullable|boolean',
            'dependents.*.attachment_type_2'       => 'nullable|string',
            'dependents.*.admission_date_2'        => 'nullable|date',
            'dependents.*.discharge_date_2'        => 'nullable|date',
            'dependents.*.status_2'                => 'nullable|string',
            'dependents.*.reason_or_purpose2'      => 'nullable|string',
        ]);
    
        // Find the patient record
        $patient = PosPatient::findOrFail($id);
    
        // Update only changed fields
        $patient->fill($validatedData);
        
        // Save only if there are changes
        if ($patient->isDirty()) {
            $patient->save();
        }
    
        // Process dependents (update existing or create new)
        if ($request->has('dependents') && is_array($request->input('dependents'))) {
            foreach ($request->input('dependents') as $depData) {
                if (isset($depData['dependent_hospital_id']) && !empty($depData['dependent_hospital_id'])) {
                    // Update existing dependent
                    $dependent = PosPatientsDependant::find($depData['dependent_hospital_id']);
                    if ($dependent) {
                        $dependent->fill($depData);
                        if ($dependent->isDirty()) {
                            $dependent->save();
                        }
                    }
                } else {
                    // Create new dependent record
                    PosPatientsDependant::create(array_merge(['health_record_id_relation_2' => $patient->health_record_id], $depData));
                }
            }
        }
    
        return response()->json(['message' => 'Patient details updated successfully']);
    }
    
    

    public function getPatientDetails($id)
    {
        $patient = PosPatient::find($id);
        
        if ($patient) {
            // Fetch the dependents related to the patient (ensure the relationship is defined in the PosPatient model)
            $dependents = $patient->dependents;
            $dependentData = [];
    
            foreach ($dependents as $dependent) {
                $dependentData[] = [
                    'dependent_first_name'      => $dependent->dependent_first_name,
                    'dependent_middle_name'     => $dependent->dependent_middle_name,
                    'dependent_last_name'       => $dependent->dependent_last_name,
                    'dependent_extension_name'  => $dependent->dependent_extension_name,
                    'dependent_relationship'    => $dependent->dependent_relationship,
                    'dependent_date_of_birth'   => $dependent->dependent_date_of_birth,
                    'dependent_mononym'         => $dependent->dependent_mononym,
                    'permanent_disability'      => $dependent->permanent_disability,
                    // Only include the type (text) field for attachment, not the blob
                    'attachment_type_2'         => $dependent->attachment_type_2,
                    'admission_date_2'          => $dependent->admission_date_2,
                    'discharge_date_2'          => $dependent->discharge_date_2,
                    'status_2'                  => $dependent->status_2,
                    'reason_or_purpose2'        => $dependent->reason_or_purpose2,
                ];
            }
    
            return response()->json([
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
                
                // **Dependent Details**
                'dependents'            => $dependentData,
            ]);
        } else {
            return response()->json(['error' => 'Patient not found'], 404);
        }
    }
    
    

    public function delete($id)
    {
        // Find the patient by ID
        $patient = PosPatient::findOrFail($id);

        // Delete all dependents related to this patient
        PosPatientDependant::where('health_record_id_relation_2', $id)->delete();

        // Delete the patient
        $patient->delete();

        // Redirect with success message
        return redirect()->back()->with('success', 'Patient and dependents deleted successfully.');
    }

    

    public function download($id, $attachment)
    {
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

            // Return the binary data as a response with the correct content type and custom file name
            return response($fileContent)
                ->header('Content-Type', $fileType)
                ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
        } else {
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
                        PosPatientDependant::create([
                            'health_record_id_relation_2' => $patient->health_record_id,
                            'dependent_first_name' => $firstName,
                            'dependent_middle_name' => $request->dependent_middle_name[$index] ?? null,
                            'dependent_last_name' => $request->dependent_last_name[$index] ?? null,
                            'dependent_extension_name' => $request->dependent_name_extension[$index] ?? null,
                            'dependent_relationship' => $request->dependent_relationship[$index] ?? null,
                            'dependent_date_of_birth' => $request->dependent_dob[$index] ?? null,
                            'dependent_mononym' => isset($request->dependent_mononym[$index]) ? 1 : 0,
                            'permanent_disability' => isset($request->dependent_permanent_disability[$index]) ? 1 : 0,
                            'attachment_type_2' => $request->attachment_type_2[$index] ?? null,
                            'attachment_2' => $request->hasFile("attachment_2.$index") ? file_get_contents($request->file("attachment_2.$index")->getRealPath()) : null,
                            'admission_date_2' => !empty($request->admission_date_2[$index]) ? $request->admission_date_2[$index] : null,
                            'discharge_date_2' => !empty($request->discharge_date_2[$index]) ? $request->discharge_date_2[$index] : null,
                            'status_2' => $request->status_2[$index] ?? null,
                            'reason_or_purpose2' => $request->reason_or_purpose2[$index] ?? null,
                        ]);
                        
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
