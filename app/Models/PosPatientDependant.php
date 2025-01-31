<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosPatientDependant extends Model
{
    use HasFactory;

    // Define the table name (if it differs from the default convention)
    protected $table = 'pos_patients_dependants';

    // Define the primary key (if it differs from the default 'id')
    protected $primaryKey = 'dependent_hospital_id';

    // Define fillable fields to allow mass assignment
    protected $fillable = [
        'health_record_id_relation_2', // Foreign key to PosPatient
        'dependent_first_name',
        'dependent_middle_name',
        'dependent_last_name',
        'dependent_extension_name',
        'dependent_relationship',
        'dependent_date_of_birth',
        'dependent_mononym',
        'permanent_disability',
    ];

    // Define casted fields
    protected $casts = [
        'dependent_date_of_birth' => 'datetime', // Cast to Carbon instance
    ];

    /**
     * Define the relationship with the PosPatient model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(PosPatient::class, 'health_record_id_relation_2', 'health_record_id');
    }
}