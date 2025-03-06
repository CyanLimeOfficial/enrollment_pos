<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PosPatient extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    // Define the table associated with the model
    protected $table = 'pos_patients';

    // Define the primary key
    protected $primaryKey = 'health_record_id';

    // Define the fields that are mass assignable
    protected $fillable = [
        'recorded_by_user_id',
        'recorded_by_user_full_name',
        'philhealth_id',
        'purpose',
        'provider_konsulta',
        'member_first_name',
        'member_middle_name',
        'member_last_name',
        'member_extension_name',
        'member_mononym',
        'mother_first_name',
        'mother_middle_name',
        'mother_last_name',
        'mother_extension_name',
        'mother_mononym',
        'spouse_first_name',
        'spouse_middle_name',
        'spouse_last_name',
        'spouse_extension_name',
        'spouse_mononym',
        'date_of_birth',
        'place_of_birth',
        'sex',
        'civil_status',
        'citizenship',
        'philsys_id',
        'tax_payer_id',
        'address',
        'contact_number',
        'home_phone_number',
        'business_direct_line',
        'email_address',
        'mailing_address',
        'admission_date',
        'discharge_date',
        'reason_or_purpose',
        'status',
        'attachment_type_1',
        'attachment_1',
    ];

    // Define the fields that should be cast to native types
    protected $casts = [
        'date_of_birth' => 'datetime',
        'admission_date' => 'datetime',
        'discharge_date' => 'datetime',
        'member_mononym' => 'boolean',
        'mother_mononym' => 'boolean',
        'spouse_mononym' => 'boolean',
    ];

    public function transformAudit(array $data): array
    {
        // Ensure all values are properly encoded
        array_walk_recursive($data, function (&$value) {
            if (is_string($value)) {
                $value = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
            }
        });

        // Exclude BLOB attachment fields
        unset(
            $data['old_values']['attachment_1'], $data['new_values']['attachment_1'],
            $data['old_values']['attachment_2'], $data['new_values']['attachment_2']
        );

        // Extract changed fields
        $changedFields = isset($data['old_values']) ? array_keys($data['old_values']) : [];
        $fieldsString = json_encode($changedFields, JSON_UNESCAPED_SLASHES);

        // Get authenticated user's full name
        $user = auth()->user();
        $fullName = $user ? trim("{$user->user_first_name} {$user->user_last_name}") : 'Unknown User';

        // Get Hospital ID safely
        $hospitalId = $data['old_values']['dependent_hospital_id'] ?? 'N/A';

        // Construct the audit message
        $data['message'] = "Action: {$data['event']} | Parent ID: {$data['auditable_id']} | Hospital ID: {$hospitalId} by {$fullName} | Changed Fields: {$fieldsString}";

        // Remove `old_values` and `new_values` to reduce log size
        unset($data['old_values'], $data['new_values']);

        return $data;
    }

    
    


    // Define the relationship with the dependents
    public function dependents()
    {
        return $this->hasMany(PosPatientDependant::class, 'health_record_id_relation_2', 'health_record_id');
    }
}