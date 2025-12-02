<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Semester;
use App\Models\Enrollment;
use App\Models\AcademicYear;
use App\Models\SubjectEnrolled;
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
        $enrolledSubjects = SubjectEnrolled::where('enrollment_id',$enrollmentInstance->id)->get();

        $subjects = [];
        $subjectsToRemove = [];
        $subjectsToEnroll = [];
        foreach($programSubjects as $subject){
            $subjectsToEnroll[] = $subject;
        }
        foreach($enrolledSubjects as $subject){
            $subjectInstance = Subject::where('id', $subject->subject_id)->first();
            $subjects[] = [
                'id' => $subject->id,
                'course_code' => $subjectInstance->course_code,
                'descriptive_title' => $subjectInstance->descriptive_title,
                'lec_units' => $subjectInstance->lec_units,
                'lab_units' => $subjectInstance->lab_units
            ];
            $subjectsToRemove[] = $subjectInstance;
        }
        $subjectsToEnroll = array_diff($subjectsToEnroll,$subjectsToRemove);
        return view('add-subjects',[
            'enrollment' => $enrollmentInstance,
            'program' => $program,
            'user' => Auth::user(),
            'student' => $student,
            'subjects' => $subjectsToEnroll,
            'enrolledSubjects' => $subjects
        ]);
    }

    public function postAddEnrolledSubject(Request $request, Enrollment $enrollment){

        if($request->subject_id == null){
            return back()->withErrors([
                'subject_id' => 'There are no subjects to add' 
            ]);
        }
        $hasEnrolledSubject = SubjectEnrolled::where('enrollment_id', $enrollment->id)->where('subject_id',$request->subject_id)->first();

        if(!$hasEnrolledSubject){
            SubjectEnrolled::create([
                'enrollment_id' => $enrollment->id,
                'subject_id' => $request->subject_id,
                'prelim' => 'IP',
                'midterm' => 'IP',
                'semi_final' => 'IP',
                'final' => 'IP'
            ]);
        }

        return back();
    }
}
