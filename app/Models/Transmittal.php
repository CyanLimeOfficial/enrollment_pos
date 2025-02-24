<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Transmittal extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    // Define the table name if it's not the plural of the model name
    protected $table = 'transmittals';

    // The attributes that are mass assignable
    protected $fillable = [
        'transmittal_id',
        'attachment_transmittal',
        'date_prepared',
        'prepared_by',
        'position',
        'number_of_claims',
        'issued_by',
        'created_at',
        'updated_at',
    ];

    // Define the date format (if required)
    protected $dates = ['created_at', 'updated_at'];

    /**
     * Define the relationship with the User model.
     * A Transmittal is issued by a User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'issued_by');
    }

    /**
     * Accessor to get the full name of the user who issued the transmittal.
     */
    public function getIssuedByFullNameAttribute()
    {
        $user = $this->user;
        if ($user) {
            return $user->first_name . ' ' . ($user->middle_name ? $user->middle_name . ' ' : '') . $user->last_name . ($user->suffix ? ' ' . $user->suffix : '');
        }
        return 'N/A';
    }

    /**
     * Transform the audit log data before saving.
     */
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
            $data['old_values']['attachment_transmittal'], 
            $data['new_values']['attachment_transmittal']
        );

        // Extract changed fields
        $changedFields = isset($data['old_values']) ? array_keys($data['old_values']) : [];
        $fieldsString = json_encode($changedFields, JSON_UNESCAPED_SLASHES);

        // Get authenticated user's full name
        $user = auth()->user();
        $fullName = $user ? trim("{$user->user_first_name} {$user->user_last_name}") : 'Unknown User';

        // Construct the audit message
        $data['message'] = "Action: {$data['event']} | Transmittal ID: {$data['auditable_id']} | Issued By: {$fullName} | Changed Fields: {$fieldsString}";

        // Remove `old_values` and `new_values` to reduce log size
        unset($data['old_values'], $data['new_values']);

        return $data;
    }
}
