<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Student;
use App\Models\Graduate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GraduateController extends Controller
{
    public function listOfGraduates(){
        $graduates = Graduate::orderBy('year','asc')->get();

        $studentList = [];

        foreach($graduates as $graduate){
            $student = Student::where('id', $graduate->student_id)->first();
            $course = Program::where('id', $student->program_id)->first();
            $studentList[] = [
                'name' => $student->last_name . ', ' . $student->first_name . ' ' . $student->middle_name,
                'course' => $course->program,
                'graduate' => $graduate
            ];
        }
        return view('list-of-graduates',[
            'graduates' => $studentList,
            'user' => Auth::user()
        ]);
    }
    public function applyForGraduation(Request $request, Student $student){
        if($request->to_accomplish > 0){
            return back()->with([
                'message' => 'This student is not eligible yet for graduation. There are ' . $request->to_accomplish . ' subject/s yet to accomplish.'
            ]);
        }else{
            //check if student has already applied for graduation
            $graduate = Graduate::where('student_id', $student->id)->first();
            if($graduate){
                return back()->with([
                    'message' => 'This student has been already applied for graduation.'
                ]);
            }else{
                Graduate::create([
                    'student_id' => $student->id,
                    'year' => date('Y'),
                    'so_number' => 'Not Applied Yet',
                    'so_application_status' => 'Not Applied Yet'
                ]);
                return back()->with([
                    'message' => 'Successfully applied for graduation.'
                ]);
            }
        }
        
    }
}
