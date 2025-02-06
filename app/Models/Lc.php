<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lc extends Model
{
    use HasFactory;

    // Define the table name (if it's not the plural form of the model name)
    protected $table = 'lcs';

    // Define the fillable columns for mass assignment
    protected $fillable = [
        'state',
        'district',
        'taluka',
        'gram',
        'student_id',
        'other_studies',
        'adhar_number',
        'student_first_name',
        'student_middle_name',
        'student_last_name',
        'mother_name',
        'nationality',
        'mother_tongue',
        'religion',
        'caste',
        'sub_caste',
        'birth_place',
        'birth_place_taluka',
        'birth_place_dist',
        'birth_place_state',
        'birth_place_country',
        'dob',
        'birth_in_text',
        'previous_school',
        'standard',
        'date_of_admission',
        'academic_progress',
        'behavior',
        'date_of_leaving_school',
        'reason_for_leaving_school',
        'comments',
        'certificate_date',
        'certificate_month',
        'certificate_year',
        'teacher_signature',
        'writer_signature',
        'principal_signature',
    ];

    // Define the timestamps if you don't want to use the default created_at and updated_at
    public $timestamps = true;
    public function grams()
    {
        return $this->belongsTo(Gram::class, 'gram');
    }
}
