<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Student;
use Illuminate\Http\Request;
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
    public function searchStudent(Request $request){
        $user = Auth::user();
        $student = Student::where('last_name','like','%'.$request->last_name.'%')->where('first_name','like','%'.$request->first_name.'%')->where('middle_name','like','%'.$request->middle_name.'%')->orderBy('last_name','asc')->get();
        return view('searched-students',[
            'students' => $student,
            'user' => $user
        ]);
    }
}
