<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\Program;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Semester;
use App\Models\Enrollment;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Models\SubjectEnrolled;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    public function enrollmentList(Request $request, Program $program)
    {
        $user = Auth::user();
        $academicYears = AcademicYear::all();
        $firstName = "";
        $lastName = "";
        $middleName = "";
        if ($request->all() == null) {
            $semester = Semester::first()->semester;
            $academicYear = date('Y') . '-' . date('Y') + 1;

        } else {
            $semester = $request->semester;
            $academicYear = $request->academic_year;
            $firstName = $request->first_name;
            $lastName = $request->last_name;
            $middleName = $request->middle_name;
        }
        $studentList = [];

        $enrollments = Enrollment::where('academic_year', $academicYear)->where('semester', $semester)->where('program_id', $program->id)->get();
        foreach($enrollments as $enrollment){
            $student = Student::where('id', $enrollment->student_id)->first();
            if($request->all() != null){
                $cond = stripos($student->last_name, $lastName) !== false && stripos($student->first_name, $firstName) !== false;
                if($cond){
                    $studentList[] = $student;
                }
            }else{
                $studentList[] = $student;
            }
        }

        return view('enrollment-list-per-program', [
            'user' => $user,
            'program' => $program,
            'academicYears' => $academicYears,
            'studentList' => $studentList
        ]);
    }
    public function enrollmentView()
    {
        $currentAcademicYear = date('Y') . "-" . (date('Y') + 1);
        $programs = Program::orderBy('program', 'asc')->get();
        $user = Auth::user();
        return view('enrollment', [
            'user' => $user,
            'currentAcademicYear' => $currentAcademicYear,
            'programs' => $programs
        ]);
    }

    public function addEnrolleeView(Program $program)
    {
        $user = Auth::user();
        $students = Student::where('program_id', $program->id)->orderBy('last_name', 'asc')->get();
        return view('add-enrollee', [
            'user' => $user,
            'students' => $students,
            'program' => $program
        ]);
    }
    public function addSubjects(Student $student)
    {
        $academicYear = date('Y') . '-' . date('Y') + 1;
        $semester = Semester::first();

        $hasActiveEnrollment = Enrollment::where('academic_year', $academicYear)->where('semester', $semester->semester)->where('student_id', $student->id)->first();


        //set enrollment instance to view enrolled subjects for the current semester
        if (!$hasActiveEnrollment) {
            $enrollmentInstance = Enrollment::create([
                'academic_year' => $academicYear,
                'semester' => $semester->semester,
                'program_id' => $student->program_id,
                'student_id' => $student->id
            ]);
        } else {
            $enrollmentInstance = $hasActiveEnrollment;
        }


        //create shift attempts if there is none
        $hasNewShift = Shift::where('student_id', $student->id)->where('program_id', $student->program_id)->first();
        if (!$hasNewShift) {
            Shift::create([
                'program_id' => $student->program_id,
                'student_id' => $student->id
            ]);
        }

        $program = Program::where('id', $student->program_id)->first();
        $programSubjects = Subject::where('program_id', $program->id)->orderBy('course_code', 'asc')->get();
        $enrolledSubjects = SubjectEnrolled::where('enrollment_id', $enrollmentInstance->id)->get();

        $subjects = [];
        $subjectsToRemove = [];
        $subjectsToEnroll = [];


        foreach ($programSubjects as $subject) {
            $subjectsToEnroll[] = $subject;
        }

        //Remove accomplished subjects from subjectsToEnroll array
        //get all enrollments of the student
        $enrollments = Enrollment::where('student_id', $student->id)->get();
        //loop through the array
        foreach ($enrollments as $enrollment) {
            //get enrolled subjects
            $subjectsEnrolled = SubjectEnrolled::where('enrollment_id', $enrollment->id)->get();
            //loop through the subjects
            foreach ($subjectsEnrolled as $subjectEnrolled) {
                //if enrolled subject is passed, then add to the subjectstoremove array
                if ($subjectEnrolled->final != 'IP' && $subjectEnrolled->final != 'NG' && $subjectEnrolled->final != 'D' && $subjectEnrolled->final != 'F' && $subjectEnrolled->final != 'INC') {
                    $subjectProper = Subject::where('id', $subjectEnrolled->subject_id)->first();
                    $subjectsToRemove[] = $subjectProper;
                }
            }
        }
        foreach ($enrolledSubjects as $subject) {
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
        $subjectsToEnroll = array_diff($subjectsToEnroll, $subjectsToRemove);
        return view('add-subjects', [
            'enrollment' => $enrollmentInstance,
            'program' => $program,
            'user' => Auth::user(),
            'student' => $student,
            'subjects' => $subjectsToEnroll,
            'enrolledSubjects' => $subjects
        ]);
    }
    public function enrollmentSummary(Request $request)
    {
        if ($request->all() == null) {
            $academicYear = date('Y') . '-' . date('Y') + 1;
            $semester = Semester::first()->semester;
        } else {
            $academicYear = $request->academic_year;
            $semester = $request->semester;
        }


        $enrollmentSummary = [];
        $programs = Program::orderBy('program','asc')->get();
        foreach($programs as $program){
            $firstMales = 0;
            $firstFemales = 0;
            $secondMales = 0;
            $secondFemales = 0;
            $thirdMales = 0;
            $thirdFemales = 0;
            $fourthMales = 0;
            $fourthFemales = 0;


            $enrollments = Enrollment::where('program_id', $program->id)->where('academic_year', $academicYear)->where('semester', $semester)->get();
            foreach($enrollments as $enrollment){
                $student = Student::where('id', $enrollment->student_id)->first();
                if($student->gender == 'Male' && $student->year_level == 1){
                    $firstMales++;
                }else if($student->gender == 'Female' && $student->year_level == 1){
                    $firstFemales++;
                }else if($student->gender == 'Male' && $student->year_level == 2){
                    $secondMales++;
                }else if($student->gender == 'Female' && $student->year_level == 2){
                    $secondFemales++;
                }else if($student->gender == 'Male' && $student->year_level == 3){
                    $thirdMales++;
                }else if($student->gender == 'Female' && $student->year_level == 3){
                    $thirdFemales++;
                }else if($student->gender == 'Male' && $student->year_level == 4){
                    $fourthMales++;
                }else if($student->gender == 'Female' && $student->year_level == 4){
                    $fourthFemales++;
                }
            }
            $enrollmentSummary[] = [
                'program' => $program->program,
                'firstMales' => $firstMales,
                'secondMales' => $secondMales,
                'thirdMales' => $thirdMales,
                'fourthMales' => $fourthMales,
                'firstFemales' => $firstFemales,
                'secondFemales' => $secondFemales,
                'thirdFemales' => $thirdFemales,
                'fourthFemales' => $fourthFemales
            ];
        }
        $academicYears = AcademicYear::orderBy('academic_year')->get();


        return view('enrollment-summary', [
            'user' => Auth::user(),
            'enrollmentSummary' => $enrollmentSummary,
            'academicYear' => $academicYear,
            'semester' => $semester,
            'academicYears' => $academicYears
        ]);

    }

    public function postAddEnrolledSubject(Request $request, Enrollment $enrollment)
    {

        if ($request->subject_id == null) {
            return back()->withErrors([
                'subject_id' => 'There are no subjects to add'
            ]);
        }
        $hasEnrolledSubject = SubjectEnrolled::where('enrollment_id', $enrollment->id)->where('subject_id', $request->subject_id)->first();

        if (!$hasEnrolledSubject) {
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
