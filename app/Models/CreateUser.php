<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CreateUser extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'users';  // Manually specify the table name

    protected $fillable = [
        'username', 'password', 'email', 'number', 'first_name', 
        'middle_name', 'last_name', 'suffix', 'profile_picture', 'user_type'
    ];

    protected $hidden = [
        'password',
    ];

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

        // Exclude sensitive fields from the audit log
        unset(
            $data['old_values']['password'], 
            $data['new_values']['password'], 
            $data['old_values']['profile_picture'], 
            $data['new_values']['profile_picture']
        );

        // Extract changed fields
        $changedFields = isset($data['old_values']) ? array_keys($data['old_values']) : [];
        $fieldsString = json_encode($changedFields, JSON_UNESCAPED_SLASHES);

        // Get authenticated user's full name
        $user = auth()->user();
        $fullName = $user ? trim("{$user->user_first_name} {$user->user_last_name}") : 'Unknown User';

        // Construct the audit message
        $data['message'] = "Action: {$data['event']} | User ID: {$data['auditable_id']} | Changed By: {$fullName} | Changed Fields: {$fieldsString}";

        // Remove `old_values` and `new_values` to reduce log size
        unset($data['old_values'], $data['new_values']);

        return $data;
    }
}
