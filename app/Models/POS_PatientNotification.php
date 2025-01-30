<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class POS_Notification extends Model
{
    protected $table = 'pos_notifications';

    protected $fillable = [
        'patient_id',
        'subject',
        'message',
        'status',
    ];

    // Relationship with POS_Patients
    public function patient()
    {
        return $this->belongsTo(POS_Patient::class, 'patient_id', 'health_record_id');
    }
}