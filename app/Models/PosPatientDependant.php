<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PosPatientDependant extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'pos_patients_dependants';
    protected $primaryKey = 'dependent_hospital_id';

    protected $fillable = [
        'health_record_id_relation_2',
        'dependent_first_name',
        'dependent_middle_name',
        'dependent_last_name',
        'dependent_extension_name',
        'dependent_relationship',
        'dependent_date_of_birth',
        'dependent_citizenship',
        'dependent_mononym',
        'permanent_disability',
        'attachment_type_2',
        'attachment_2', // Consider changing to file path
        'admission_date_2',
        'status_2',
        'discharge_date_2',
        'reason_or_purpose2',
    ];

    protected $casts = [
        'dependent_date_of_birth' => 'datetime',
        'admission_date_2' => 'datetime',
        'discharge_date_2' => 'datetime',
        'dependent_mononym' => 'boolean',
        'permanent_disability' => 'boolean',
    ];

    public function transformAudit(array $data): array
    {
        // Remove attachment fields to prevent large BLOB data
        if (isset($data['old_values']['attachment_1'])) {
            unset($data['old_values']['attachment_1']);
        }
        if (isset($data['old_values']['attachment_2'])) {
            unset($data['old_values']['attachment_2']);
        }
        if (isset($data['new_values']['attachment_1'])) {
            unset($data['new_values']['attachment_1']);
        }
        if (isset($data['new_values']['attachment_2'])) {
            unset($data['new_values']['attachment_2']);
        }
    
        // Extract changed fields and format the audit message
        $changedFields = isset($data['old_values']) ? array_keys($data['old_values']) : [];
        $fieldsString = json_encode($changedFields, JSON_UNESCAPED_SLASHES);
    
        // Fetch the user's full name
        $user = auth()->user();
        $fullName = $user ? $user->user_first_name . ' ' . $user->user_last_name : 'Unknown User';
    
        // Get Hospital ID safely
        $hospitalId = isset($data['old_values']['dependent_hospital_id']) ? $data['old_values']['dependent_hospital_id'] : 'N/A';
    
        // Format audit message
        $data['message'] = "Action: " . $data['event'] . " | Parent ID: " . $data['auditable_id'] . 
                           " | Hospital ID: " . $hospitalId . " by " . $fullName . 
                           " | Changed Fields: " . $fieldsString;
    
        // Remove the long old/new values fields from audit logs
        unset($data['old_values'], $data['new_values']);
    
        return $data;
    }
    
    
    


    public function patient()
    {
        return $this->belongsTo(PosPatient::class, 'health_record_id_relation_2', 'health_record_id');
    }
}