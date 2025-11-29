<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Semester;
use App\Models\Enrollment;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    public function enrollmentList(Program $program){
        $user = Auth::user();
        $academicYears = AcademicYear::all();
        return view('enrollment-list-per-program',[
            'user' => $user,
            'program' => $program,
            'academicYears' => $academicYears
        ]);
    }
    public function enrollmentView(){
        $currentAcademicYear = date('Y') . "-" . (date('Y') + 1);
        $programs = Program::orderBy('program','asc')->get();
        $user = Auth::user();
        return view('enrollment',[
            'user' => $user,
            'currentAcademicYear' => $currentAcademicYear,
            'programs' => $programs
        ]);
    }

    public function addEnrolleeView(Program $program){
        $user = Auth::user();
        $students = Student::where('program_id', $program->id)->orderBy('last_name', 'asc')->get();
        return view('add-enrollee',[
            'user' => $user,
            'students' => $students,
            'program' => $program
        ]);
    }
    public function addSubjects(Student $student){
        $academicYear = date('Y'). '-' . date('Y') + 1;
        $semester = Semester::first();

        $hasActiveEnrollment = Enrollment::where('academic_year', $academicYear)->where('semester', $semester->semester)->where('student_id', $student->id)->first();

        if(!$hasActiveEnrollment){
            $enrollmentInstance = Enrollment::create([
                'academic_year' => $academicYear,
                'semester' => $semester->semester,
                'student_id' => $student->id
            ]);
        }else{
            $enrollmentInstance = $hasActiveEnrollment;
        }
        $program = Program::where('id', $student->program_id)->first();
        $programSubjects = Subject::where('program_id', $program->id)->orderBy('course_code','asc')->get();
        return view('add-subjects',[
            'enrollment' => $enrollmentInstance,
            'program' => $program,
            'user' => Auth::user(),
            'student' => $student,
            'subjects' => $programSubjects
        ]);
    }
}
