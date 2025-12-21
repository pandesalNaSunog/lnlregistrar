<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'year',
        'semester',
        'course_code',
        'descriptive_title',
        'lab_units',
        'lec_units',
        'numeric_year'
    ];
}
