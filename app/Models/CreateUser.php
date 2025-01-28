<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreateUser extends Model
{
    use HasFactory;
    protected $table = 'users';  // Manually specify the table name if different from convention
    protected $fillable = [
        'username', 'password', 'email', 'number', 'first_name', 
        'middle_name', 'last_name', 'suffix', 'profile_picture', 'user_type'
    ];

    protected $hidden = [
        'password',
    ];
}
