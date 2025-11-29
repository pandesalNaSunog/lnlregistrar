<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectEnrolled extends Model
{
    use HasFactory;
    protected $fillable = [
        'enrollment_id',
        'subject_id',
        'prelim',
        'midterm',
        'semi_final',
        'final'
    ];
}
