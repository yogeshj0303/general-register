<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Population extends Model
{
    use HasFactory;
    protected $fillable = [
        'state',
        'district',
        'taluka',
        'gram',
        'population',
        'year',
        'confirm_by',
    ];
}
