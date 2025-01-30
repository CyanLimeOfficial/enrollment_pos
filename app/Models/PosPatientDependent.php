<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosPatientDependent extends Model
{
    use HasFactory;

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
        'dependent_mononym',
        'permanent_disability',
    ];

    protected $casts = [
        'dependent_date_of_birth' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(PosPatient::class, 'health_record_id_relation_2', 'health_record_id');
    }
}
