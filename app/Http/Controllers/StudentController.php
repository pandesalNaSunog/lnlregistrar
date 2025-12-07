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

class StudentController extends Controller
{
    public function postAddStudent(Request $request){
        $request->validate([
            'last_name' => 'required',
            'first_name' => 'required'
        ]);


        $student = Student::create($request->all());
        $sem = Semester::first();
        Enrollment::create([
            'student_id' => $student->id,
            'academic_year' => date('Y').'-'.date('Y')+1,
            'semester' => $sem->semester,
            'program_id' => $student->program_id
        ]);
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
        return back()->with([
            'message' => 'Grade successfully encoded.'
        ]);
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
        $enrollments = Enrollment::where('student_id', $student->id)->get();
        $studentRecord = [];
        $currentProgram = Program::where('id', $student->program_id)->first();
        $shiftPrograms = Program::where('id','<>',$student->program_id)->orderBy('program','asc')->get();
        $currentProgramSubjects = Subject::where('program_id', $currentProgram->id)->get();
        $currentSubjects = [];
        foreach($currentProgramSubjects as $programSubject){
            $currentSubjects[] = $programSubject->course_code;
        }
        $accomplishedSubjects = [];
        foreach($enrollments as $enrollment){
            $academicYear = $enrollment->academic_year;
            $semester = $enrollment->semester;
            $program = Program::where('id', $enrollment->program_id)->first();
            $enrolledSubjects = SubjectEnrolled::where('enrollment_id', $enrollment->id)->get();

            $subjectsEnrolled = [];

            foreach($enrolledSubjects as $subject){
                $subjectProper = Subject::where('id', $subject->subject_id)->first();
                $units = $subjectProper->lec_units + $subjectProper->lab_units;
                $subjectsEnrolled[] = [
                    'course_code' => $subjectProper->course_code,
                    'descriptive_title' => $subjectProper->descriptive_title,
                    'units' => $units,
                    'grade' => $subject->final
                ];
                foreach($currentProgramSubjects as $currentProgramSubject){
                    $ifPassed = $subject->final != 'IP' && $subject->final != 'NG' && $subject->final != 'D' && $subject->final != 'F' && $subject->final != 'INC';
                    if($currentProgramSubject->course_code == $subjectProper->course_code && $ifPassed){
                        $accomplishedSubjects[] = $subjectProper->course_code;
                    }
                }
            }
    
            $studentRecord[] = [
                'academic_year' => $academicYear,
                'semester' => $semester,
                'program' => $program->program,
                'enrolled_subjects' => $subjectsEnrolled
            ];
        }
        $activeSemester = Semester::first();
        $toBeAccomplishedSubjects = array_diff($currentSubjects, $accomplishedSubjects);
        return view('student-record',[
            'user' => Auth::user(),
            'studentRecord' => $studentRecord,
            'student' => $student,
            'program' => $currentProgram,
            'shiftPrograms' => $shiftPrograms,
            'activeSemester' => $activeSemester,
            'toBeAccomplishedSubjects' => $toBeAccomplishedSubjects
        ]);
        
    }
    public function shiftProgram(Student $student, Request $request){
        $student->update([
            'program_id' => $request->program_id
        ]);
        Shift::create([
            'student_id' => $student->id,
            'program_id' => $request->program_id
        ]);
        return back()->with([
            'message' => 'Student course has been shifted.'
        ]);
    }
    public function grades(Request $request){

        if($request->has(['last_name']) || $request->has(['first_name']) || $request->has(['first_name'])){

            $students = Student::where('last_name','like','%'.$request->last_name.'%')->where('first_name','like','%'.$request->first_name.'%')->where('middle_name','like','%'.$request->middle_name.'%')->orderBy('last_name','asc')->paginate(1)->withQueryString();
        }else{
            $students = Student::orderBy('last_name','asc')->paginate(1)->withQueryString();
        }
        $academicYears = AcademicYear::orderBy('academic_year','desc')->get();

        $courses = [];
        $studentsEnrolled = [];
        foreach($students as $student){
            if($request->has(['last_name','first_name','middle_name'])){

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
            'studentPagination' => $students,
            'courses' => $courses
        ]);
    }
}
