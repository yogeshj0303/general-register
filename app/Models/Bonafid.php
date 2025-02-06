<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bonafid extends Model
{
    use HasFactory;

    protected $table = 'bonafids';

    protected $fillable = [
        'state',
        'district',
        'taluka',
        'school_name',
        'school_address',
        'student_name',
        'general_register_number',
        'religion',
        'caste',
        'dob',
        'birth_in_text',
        'birth_place',
        'birth_place_taluka',
        'birth_place_dist',
        'certificate_issued_date',
        'principal_signature',
    ];
       public function gram()
    {
        return $this->belongsTo(Gram::class, 'school_name');
    }
    
    
    
}
