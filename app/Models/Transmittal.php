<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transmittal extends Model
{
    use HasFactory;

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
     * You can use this in your blade views for displaying the full name of the user.
     */
    public function getIssuedByFullNameAttribute()
    {
        $user = $this->user;
        if ($user) {
            return $user->first_name . ' ' . ($user->middle_name ? $user->middle_name . ' ' : '') . $user->last_name . ($user->suffix ? ' ' . $user->suffix : '');
        }
        return 'N/A';
    }

}
