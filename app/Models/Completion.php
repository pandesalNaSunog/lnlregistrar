<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Completion extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_enrolled_id',
        'term',
        'completion_grade',
        'completion_form'
    ];
}
