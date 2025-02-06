<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
protected $fillable = [
    'name',
    'email', // Added Gmail field
    'password',
    'avatar',
    'state',
    'district',
    'taluka',
    'gram',
    'contact_no',
    'profile_pic', // Profile picture field
    'gender',
    'dob',
    'age',
    'user_type', // This is the foreign key
    'otp_expires_at'
];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the role associated with the user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'user_type', 'id');
    }
}
