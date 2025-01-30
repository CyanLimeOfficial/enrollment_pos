<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosPatient extends Model
{
    use HasFactory;

    protected $table = 'pos_patients';

    protected $primaryKey = 'health_record_id';

    protected $fillable = [
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
        'attachment_type_2',
        'attachment_2',
    ];

    protected $casts = [
        'date_of_birth' => 'datetime',
        'admission_date' => 'datetime',
        'discharge_date' => 'datetime',
    ];

    public function dependents()
    {
        return $this->hasMany(PosPatientDependant::class, 'health_record_id_relation_2', 'health_record_id');
    }
}
