<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Program;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Semester;
use App\Models\Enrollment;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Models\SubjectEnrolled;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function createAccounts()
    {


        User::create([
            'last_name' => 'Licay',
            'first_name' => 'Joey',
            'middle_name' => 'Dunno',
            'username' => 'JoeyLicay',
            'password' => 'password'
        ]);
        User::create([
            'last_name' => 'Pequet',
            'first_name' => 'Euro',
            'middle_name' => 'Lagundi',
            'username' => 'EuroPequet',
            'password' => 'password'
        ]);


        return response([
            'message' => 'ok'
        ]);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($fields)) {
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records'
        ]);
    }
    public function dashboard()
    {
        $user = Auth::user();
        $programs = Program::orderBy('program', 'asc')->get();

        $yearLevels = [1, 2, 3, 4];
        $enrollmentReport = [];

        $academicYear = date('Y') . '-' . date('Y') + 1;
        $semester = Semester::first()->semester;
        
        foreach ($programs as $program) {
            foreach ($yearLevels as $level) {
                $maxEnrolledSubjects = 0;
                $subjectTableHeads = [];
                $enrollments = Enrollment::where('program_id', $program->id)->where('academic_year', $academicYear)->where('semester', $semester)->get();
                $students = [];
                foreach ($enrollments as $enrollment) {
                    $student = Student::where('id', $enrollment->student_id)->where('year_level', $level)->first();
                    $enrolledSubjects = [];
                    if ($student) {
                        $subjectsEnrolled = SubjectEnrolled::where('enrollment_id', $enrollment->id)->get();

                        //compare if max enrolled subjects is less than number of subjects enrolled
                        if($maxEnrolledSubjects < count($subjectsEnrolled)){
                            $maxEnrolledSubjects = $maxEnrolledSubjects + (count($subjectsEnrolled) - $maxEnrolledSubjects);
                        
                        }
                        foreach($subjectsEnrolled as $enrolled){
                            
                            $subjectProper = Subject::where('id', $enrolled->subject_id)->first();
                            $units = $subjectProper->lec_units + $subjectProper->lab_units;
                            $enrolledSubjects[] = [
                                'course_code' => $subjectProper->course_code,
                                'units' => $units
                            ];
                        }
                        $students[] = [
                            'student' => $student,
                            'enrolledSubjects' => $enrolledSubjects
                        ];
                    }
                }
                usort($students, function ($a, $b) {
                    return $a['student']->last_name <=> $b['student']->last_name;
                });

                for($index = 0;$index < $maxEnrolledSubjects;$index ++){
                    $subjectTableHeads[] = ['Subject '.$index+1,'Units'];
                }

                $enrollmentReport[] = [
                    'max_enrolled_subjects' => $maxEnrolledSubjects,
                    'program' => $program->program,
                    'year_level' => $level,
                    'students' => $students,
                    'subject_table_heads' => $subjectTableHeads
                ];
            }
        }
        return view('dashboard', [
            'user' => $user,
            'enrollmentReport' => $enrollmentReport
        ]);
    }
    public function promotionReport(){
        $user = Auth::user();
        $programs = Program::orderBy('program', 'asc')->get();

        $yearLevels = [1, 2, 3, 4];
        $promotionReport = [];

        $academicYear = date('Y') . '-' . date('Y') + 1;
        $semester = Semester::first()->semester;
        
        foreach ($programs as $program) {
            foreach ($yearLevels as $level) {
                $maxEnrolledSubjects = 0;
                $subjectTableHeads = [];
                $enrollments = Enrollment::where('program_id', $program->id)->where('academic_year', $academicYear)->where('semester', $semester)->get();
                $students = [];
                foreach ($enrollments as $enrollment) {
                    $student = Student::where('id', $enrollment->student_id)->where('year_level', $level)->first();
                    $enrolledSubjects = [];
                    if ($student) {
                        $subjectsEnrolled = SubjectEnrolled::where('enrollment_id', $enrollment->id)->get();

                        //compare if max enrolled subjects is less than number of subjects enrolled
                        if($maxEnrolledSubjects < count($subjectsEnrolled)){
                            $maxEnrolledSubjects = $maxEnrolledSubjects + (count($subjectsEnrolled) - $maxEnrolledSubjects);
                        
                        }
                        foreach($subjectsEnrolled as $enrolled){
                            
                            $subjectProper = Subject::where('id', $enrolled->subject_id)->first();

                            $enrolledSubjects[] = [
                                'course_code' => $subjectProper->course_code,
                                'grade' => $enrolled->final
                            ];
                        }
                        $students[] = [
                            'student' => $student,
                            'enrolledSubjects' => $enrolledSubjects
                        ];
                    }
                }
                usort($students, function ($a, $b) {
                    return $a['student']->last_name <=> $b['student']->last_name;
                });

                for($index = 0;$index < $maxEnrolledSubjects;$index ++){
                    $subjectTableHeads[] = ['Subject '.$index+1,'Grade'];
                }

                $promotionReport[] = [
                    'max_enrolled_subjects' => $maxEnrolledSubjects,
                    'program' => $program->program,
                    'year_level' => $level,
                    'students' => $students,
                    'subject_table_heads' => $subjectTableHeads
                ];
            }
        }
        return view('promotion-report', [
            'user' => $user,
            'promotionReport' => $promotionReport
        ]);
    }
    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login'));
    }
    public function loginView()
    {
        $todaysAcademicYear = date('Y') . "-" . (date('Y') + 1);

        $hasTodaysAcademicYear = AcademicYear::where('academic_year', $todaysAcademicYear)->first();
        if (!$hasTodaysAcademicYear) {
            AcademicYear::create([
                'academic_year' => $todaysAcademicYear
            ]);
        }

        $hasActiveSemester = Semester::all();
        if (count($hasActiveSemester) == 0) {
            Semester::create([
                'semester' => 'First Semester'
            ]);
        }
        return view('welcome');
    }
}
