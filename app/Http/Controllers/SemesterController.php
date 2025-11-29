<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SemesterController extends Controller
{
    //

    public function activeSemester(){
        $activeSem = Semester::first();

        return view('active-semester',[
            'user' => Auth::user(),
            'activeSemester' => $activeSem->semester
        ]);
    }
    public function updateActiveSemester(Request $request){
        $sem = Semester::first();
        $sem->update([
            'semester' => $request->semester
        ]);

        return back();
    }
}
