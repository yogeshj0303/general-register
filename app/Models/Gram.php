<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gram extends Model
{
    use HasFactory;
protected $fillable = [
    'gram_name',
    'state',
    'district',
    'taluka',
    'village',
    'address',
    'pin_code',
    'school_contact_no',
    'school_gmail',
    'school_gram_no',
    'school_management',
    'school_level',
    'school_udash_no',
    'school_board',
     'school_details_id',
        'principal_name',
        'principal_type',
        'principle_whatsapp_no',
        'clerk_name',
        'clerk_whatspp_no',
        'school_logo',
];

   public function bonafids()
    {
        return $this->hasMany(Bonafid::class, 'school_name'); 
    }
    
   public function lc()
    {
        return $this->hasMany(Lc::class, 'gram'); 
    }
    


}
