<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    use HasFactory;

    protected $table; // Dynamically set table

    protected $fillable = [
        'user_type',
        'user_id',
        'event',
        'old_values',
        'new_values',
        'url',
        'message',
        'ip_address',
        'user_agent',
        'tags',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('audit.drivers.database.table', 'audits');
    }

    public function auditable()
    {
        return $this->morphTo();
    }
}
