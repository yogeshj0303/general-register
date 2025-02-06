<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taluka extends Model
{
    use HasFactory;
    protected $fillable = ['state','district','taluka_name'];
}
