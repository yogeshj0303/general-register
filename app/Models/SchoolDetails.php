<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'class_name',
        'class_teacher_name',
        'whatsapp_no',
    ];
}
