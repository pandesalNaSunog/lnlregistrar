<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'program_id',
        'civil_status',
        'gender',
        'date_of_birth',
        'place_of_birth',
        'guardian',
        'contact_number',
        'address',
        'email',
        'type'
    ];
}
