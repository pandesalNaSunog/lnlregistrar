<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Completion;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Models\SubjectEnrolled;
use Illuminate\Support\Facades\Auth;

class CompletionController extends Controller
{
    public function addCompletion(SubjectEnrolled $subjectEnrolled){
        $user = Auth::user();
        $enrollment = Enrollment::where('id', $subjectEnrolled->enrollment_id)->first();
        
        $student = Student::where('id', $enrollment->student_id)->first();
        $program = Program::where('id', $student->program_id)->first();
        $enrolledSubjectDetails = Subject::where('id', $subjectEnrolled->subject_id)->first();

        $completions = Completion::where('subject_enrolled_id', $subjectEnrolled->id)->get();
        return view('add-completion',[
            'user' => $user,
            'student' => $student,
            'program' => $program,
            'enrollment' => $enrollment,
            'subject' => $enrolledSubjectDetails,
            'subjectEnrolled' => $subjectEnrolled,
            'completions' => $completions
        ]);
    }
    public function postAddCompletion(Request $request, SubjectEnrolled $subjectEnrolled){
        if(!$request->hasFile('completion_form')){
            return back()->withErrors([
                'completion_form' => 'Please upload the completion form.'
            ]);
        }

        $path = $request->file('completion_form')->store('images','public');

        Completion::create([
            'subject_enrolled_id' => $subjectEnrolled->id,
            'term' => $request->term,
            'completion_grade' => $request->completion_grade,
            'completion_form' => $path
        ]);

        return back()->with([
            'message' => 'Completion details has been encoded.'
        ]);
    }
}
