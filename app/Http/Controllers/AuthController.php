<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Semester;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function createAccounts(){
        

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

    public function login(Request $request){
        $fields = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($fields)){
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records'
        ]);
    }
    public function dashboard(){
        $user = Auth::user();

        return view('dashboard',[
            'user' => $user
        ]);
    }
    public function logout(Request $request){
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login'));
    }
    public function loginView(){
        $todaysAcademicYear = date('Y') . "-" . (date('Y') + 1);

        $hasTodaysAcademicYear = AcademicYear::where('academic_year', $todaysAcademicYear)->first();
        if(!$hasTodaysAcademicYear){
            AcademicYear::create([
                'academic_year' => $todaysAcademicYear
            ]);
        }

        $hasActiveSemester = Semester::all();
        if(count($hasActiveSemester) == 0){
            Semester::create([
                'semester' => 'First Semester'
            ]);
        }
        return view('welcome');
    }
}
