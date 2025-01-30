<?php

namespace App\Http\Controllers\Admin;

use App\Models\PosPatientDependent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PosPatient;
use Illuminate\Support\Facades\Validator;

class AdminPatientController extends Controller
{
    /**
     * Redirect to the patient management page.
     */
    public function redirectToPatients()
    {
        return view('admin.patient_admin'); 
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
                        PosPatientDependent::create([
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
