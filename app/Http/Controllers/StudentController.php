<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Program;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Semester;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Models\SubjectEnrolled;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function postAddStudent(Request $request){
        $request->validate([
            'last_name' => 'required',
            'first_name' => 'required'
        ]);

        Student::create($request->all());

        return redirect(route('add-enrollee',$request->program_id));


        
    }
    public function addStudentView(Program $program){
        $user = Auth::user();
        return view('add-student',[
            'user' => $user,
            'program' => $program
        ]);
    }

    public function viewStudentRecords(){
        return view('student-records',[
            'user' => Auth::user()
        ]);
    }

    public function viewGrades(Enrollment $enrollment){
        $enrolledSubjects = SubjectEnrolled::where('enrollment_id', $enrollment->id)->get();
        $subjectEnrolled = [];
        $studentInformation = Student::where('id', $enrollment->student_id)->first();
        $program = Program::where('id', $studentInformation->program_id)->first();
        foreach($enrolledSubjects as $enrolledSubject){
            $subjectDetails = Subject::where('id', $enrolledSubject->subject_id)->first();
            $subjectEnrolled[] = [
                'course_code' => $subjectDetails->course_code,
                'descriptive_title' => $subjectDetails->descriptive_title,
                'lec_units' => $subjectDetails->lec_units,
                'lab_units' => $subjectDetails->lab_units,
                'enrolled_subject' => $enrolledSubject
            ];
        };
        return view('view-grades',[
            'user' => Auth::user(),
            'student' => $studentInformation,
            'program' => $program,
            'subjects' => $subjectEnrolled,
            'enrollment' => $enrollment
        ]);
    }

    public function updateGrade(Request $request, SubjectEnrolled $subjectEnrolled){
        $subjectEnrolled->update([
            'prelim' => $request->prelim,
            'midterm' => $request->midterm,
            'semi_final' => $request->semi_final,
            'final' => $request->final
        ]);
        return back();
    }
    public function searchStudent(Request $request){
        $user = Auth::user();
        $students = Student::where('last_name','like','%'.$request->last_name.'%')->where('first_name','like','%'.$request->first_name.'%')->where('middle_name','like','%'.$request->middle_name.'%')->orderBy('last_name','asc')->get();
        $courses = [];
        foreach($students as $student){
            $program = Program::where('id', $student->program_id)->first();
            $courses[] = [
                'course' => $program->program
            ];
        }
        return view('searched-students',[
            'students' => $students,
            'user' => $user,
            'courses' => $courses
        ]);
    }
    public function viewStudentRecord(Student $student){
        $program = Program::where('id', $student->program_id)->first();
        $enrollments = Enrollment::where('student_id', $student->id)->get();

        $enrolledSubjectData = [];
        $unitsData = [];
        $gradeData = [];
        foreach($enrollments as $enrollment){
            $subjectsEnrolled = SubjectEnrolled::where('enrollment_id', $enrollment->id)->get();
            $enrolledSubjects = [];
            $units = [];
            $grades = [];
            foreach($subjectsEnrolled as $subject){
                $grades[] = $subject->final;
                $subjectProper = Subject::where('id', $subject->subject_id)->first();
                $enrolledSubjects[] = $subjectProper;
                $units[] = $subjectProper->lec_units + $subjectProper->lab_units;
            }
            $gradeData[] = $grades;
            $enrolledSubjectData[] = $enrolledSubjects;
            $unitsData[] = $units;
        }
        return view('student-record',[
            'user' => Auth::user(),
            'student' => $student,
            'program' => $program,
            'enrollments' => $enrollments,
            'enrolledSubjects' => $enrolledSubjectData,
            'units' => $unitsData,
            'grades' => $gradeData
        ]);
    }
    public function grades(Request $request){
        if($request->all() != null){

            $students = Student::where('last_name','like','%'.$request->last_name.'%')->where('first_name','like','%'.$request->first_name.'%')->where('middle_name','like','%'.$request->middle_name.'%')->orderBy('last_name','asc')->get();
        }else{
            $students = Student::orderBy('last_name','asc')->get();
        }
        $academicYears = AcademicYear::orderBy('academic_year','desc')->get();

        $courses = [];
        $studentsEnrolled = [];
        foreach($students as $student){
            if($request->all() != null){

                $isEnrolled = Enrollment::where('academic_year',$request->academic_year)->where('semester',$request->semester)->where('student_id', $student->id)->first();
            }else{
                $activeSemester = Semester::first();
                $isEnrolled = Enrollment::where('academic_year',date('Y').'-'.date('Y')+1)->where('semester',$activeSemester->semester)->where('student_id', $student->id)->first();
            }
            $program = Program::where('id', $student->program_id)->first();
            if($isEnrolled){
                $studentsEnrolled[] = [
                    'enrollment_id'=> $isEnrolled->id,
                    'sem' => $isEnrolled->semester,
                    'student' => $student
                ];
                $courses[] = $program;
            }
            
        }
        $sem = Semester::first();
        return view('grades',[
            'user' => Auth::user(),
            'academicYears' => $academicYears,
            'activeSemester' => $sem,
            'students' => $studentsEnrolled,
            'courses' => $courses
        ]);
    }
}
