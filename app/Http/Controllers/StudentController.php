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
}
