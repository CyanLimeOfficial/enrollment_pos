<?php

namespace App\Http\Controllers\Admin;

use App\Models\PosPatient;
use App\Models\PosPatientDependant;
use Carbon\Carbon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminPatientController extends Controller
{
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
                'pos_patients.philhealth_id as pin',
                'pos_patients.attachment_1',
                'pos_patients.attachment_2',
                'pos_patients.attachment_type_1',
                'pos_patients.attachment_type_2',
                'pos_patients.reason_or_purpose',
                'pos_patients_dependants.dependent_first_name',
                'pos_patients_dependants.dependent_middle_name',
                'pos_patients_dependants.dependent_last_name',
                'pos_patients_dependants.dependent_extension_name',
                'pos_patients_dependants.dependent_date_of_birth',
                'pos_patients.member_first_name',
                'pos_patients.member_middle_name',
                'pos_patients.member_last_name',
                'pos_patients.member_extension_name'
            )
            ->get()
            ->map(function ($patient) {
                // Calculate derived fields
                $patient->date_of_expiry = Carbon::parse($patient->discharge_date)->addDays(61)->format('Y-m-d');
                $patient->remaining_days = (int) max(0, Carbon::parse($patient->admission_date)->addDays(61)->diffInDays(Carbon::now()));
    
                // Format member full name
                $memberNameParts = array_filter([
                    $patient->member_first_name,
                    $patient->member_middle_name,
                    $patient->member_last_name,
                    $patient->member_extension_name
                ]);
                $patient->member_full_name = implode(' ', $memberNameParts);
    
                // Format dependent full name (if dependent data exists)
                $dependentNameParts = array_filter([
                    $patient->dependent_first_name,
                    $patient->dependent_middle_name,
                    $patient->dependent_last_name,
                    $patient->dependent_extension_name
                ]);
                $patient->dependent_full_name = implode(' ', $dependentNameParts);
    
                // If there is no dependent data, provide a default value
                if (empty($dependentNameParts)) {
                    $patient->dependent_full_name = 'No dependent information available';
                    $patient->dependent_date_of_birth = 'N/A'; // You can change this default value
                }
    
                return $patient;
            });
    
        return view('admin.patient_admin', compact('patients'));
    }

    public function getPatientDetails($id)
    {
        $enrolled_pos_patient = PosPatient::find($id);
        
        if ($enrolled_pos_patient) {
            // Fetch the dependents related to the patient
            $dependents = $enrolled_pos_patient->dependents;  // assuming you have defined the relationship in the PosPatient model
            
            // Prepare dependent data
            $dependentData = [];
            
            // Loop through each dependent and add to the array
            foreach ($dependents as $dependent) {
                $dependentData[] = [
                    'dependent_first_name' => $dependent->dependent_first_name,
                    'dependent_middle_name' => $dependent->dependent_middle_name,
                    'dependent_last_name' => $dependent->dependent_last_name,
                    'dependent_extension_name' => $dependent->dependent_extension_name,
                    'dependent_relationship' => $dependent->dependent_relationship,
                    'dependent_date_of_birth' => $dependent->dependent_date_of_birth,
                    'dependent_mononym' => $dependent->dependent_mononym,
                    'permanent_disability' => $dependent->permanent_disability,
                ];
            }
    
            // Return detailed patient data along with dependent information in a structured JSON format
            return response()->json([
                'health_record_id' => $enrolled_pos_patient->health_record_id,
                'philhealth_id' => $enrolled_pos_patient->philhealth_id,
                'purpose' => $enrolled_pos_patient->purpose,
                'provider_konsulta' => $enrolled_pos_patient->provider_konsulta,
    
                // Member information
                'member_first_name' => $enrolled_pos_patient->member_first_name,
                'member_middle_name' => $enrolled_pos_patient->member_middle_name,
                'member_last_name' => $enrolled_pos_patient->member_last_name,
                'member_extension_name' => $enrolled_pos_patient->member_extension_name,
                'member_mononym' => $enrolled_pos_patient->member_mononym,
    
                // Mother's information
                'mother_first_name' => $enrolled_pos_patient->mother_first_name,
                'mother_middle_name' => $enrolled_pos_patient->mother_middle_name,
                'mother_last_name' => $enrolled_pos_patient->mother_last_name,
                'mother_extension_name' => $enrolled_pos_patient->mother_extension_name,
                'mother_mononym' => $enrolled_pos_patient->mother_mononym,
    
                // Spouse's information
                'spouse_first_name' => $enrolled_pos_patient->spouse_first_name,
                'spouse_middle_name' => $enrolled_pos_patient->spouse_middle_name,
                'spouse_last_name' => $enrolled_pos_patient->spouse_last_name,
                'spouse_extension_name' => $enrolled_pos_patient->spouse_extension_name,
                'spouse_mononym' => $enrolled_pos_patient->spouse_mononym,
    
                // Other personal details
                'date_of_birth' => $enrolled_pos_patient->date_of_birth,
                'place_of_birth' => $enrolled_pos_patient->place_of_birth,
                'sex' => $enrolled_pos_patient->sex,
                'civil_status' => $enrolled_pos_patient->civil_status,
                'citizenship' => $enrolled_pos_patient->citizenship,
                'philsys_id' => $enrolled_pos_patient->philsys_id,
                'tax_payer_id' => $enrolled_pos_patient->tax_payer_id,
    
                // Contact information
                'address' => $enrolled_pos_patient->address,
                'contact_number' => $enrolled_pos_patient->contact_number,
                'home_phone_number' => $enrolled_pos_patient->home_phone_number,
                'business_direct_line' => $enrolled_pos_patient->business_direct_line,
                'email_address' => $enrolled_pos_patient->email_address,
                'mailing_address' => $enrolled_pos_patient->mailing_address,
    
                // Admission details
                'admission_date' => $enrolled_pos_patient->admission_date,
                'discharge_date' => $enrolled_pos_patient->discharge_date,
    
                // Newly added fields
                'reason_or_purpose' => $enrolled_pos_patient->reason_or_purpose,
                'status' => $enrolled_pos_patient->status,
                'attachment_type_1' => $enrolled_pos_patient->attachment_type_1,
                'attachment_type_2' => $enrolled_pos_patient->attachment_type_2,
                
                // Dependent information
                'dependents' => $dependentData,  // return the array of dependents
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
            'admission_date' => 'required|date',
            // Validate dependents if provided
            'dependents' => 'nullable|array|max:4',
            'dependents.*.dependent_first_name' => 'required_with:dependents.*|string',
            'dependents.*.dependent_middle_name' => 'required_with:dependents.*|string',
            'dependents.*.dependent_last_name' => 'required_with:dependents.*|string',
            'dependents.*.dependent_relationship' => 'required_with:dependents.*|string',
            'dependents.*.dependent_date_of_birth' => 'required_with:dependents.*|date',
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
                'attachment_type_2' => $request->attachment_type_2,
                'attachment_2' => $request->hasFile('attachment_2') ? file_get_contents($request->file('attachment_2')->getRealPath()) : null,
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
