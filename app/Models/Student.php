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
        'first_generation_student',
        'member_of_ip',
        'ip_group',
        'solo_parent_student',
        'student_with_solo_parent',
        'pwd_student',
        'student_with_pwd_parent',
        'type_of_disability',
        'senior_citizen_student',
        'student_with_senior_citizen_parent',
        'student_with_ofw_parent',
        'program_id',
        'civil_status',
        'gender',
        'date_of_birth',
        'place_of_birth',
        'guardian',
        'contact_number',
        'address',
        'email',
        'elementary',
        'elem_year_grad',
        'secondary',
        'secondary_year_grad',
        'type',
        'year_level'
    ];
}
