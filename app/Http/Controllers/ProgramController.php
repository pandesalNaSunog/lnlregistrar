<?php

namespace App\Http\Controllers;

use App\Models\Preqrequisite;
use App\Models\Program;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    public function postAddPrerequisite(Request $request, Subject $subject){
        function createPrerequisites($prerequisites, $subject){
            foreach($prerequisites as $prerequisite){
                Preqrequisite::create([
                    'subject_id' => $subject->id,
                    'prerequisite_id' => $prerequisite->id
                ]);
            }
        }
        if($request->prerequisite_id == "None"){
            Preqrequisite::where('subject_id', $subject->id)->delete();
            
        }else if($request->prerequisite_id == "Third Year Standing"){
            $prerequisites = Subject::where('year','First Year')->orWhere('year','Second Year')->where('program_id',$subject->program_id)->get();

            createPrerequisites($prerequisites, $subject);
        }else if($request->prerequisite_id == "Fourth Year Standing"){
            $prerequisites = Subject::where('year','First Year')->orWhere('year','Second Year')->orWhere('year','Third Year')->where('program_id',$subject->program_id)->get();

            createPrerequisites($prerequisites, $subject);
        }else{
            $prerequisites = Preqrequisite::where('subject_id', $subject->id)->where('prerequisite_id', $request->prerequisite_id)->first();
            if(!$prerequisites){
                Preqrequisite::create([
                    'subject_id' => $subject->id,
                    'prerequisite_id' => $request->prerequisite_id
                ]);
            }
        }
        return back();
    }

    public function addPrerequisiteView(Subject $subject){

        $chosenSubject = $subject;
        $allSubjects = Subject::where('program_id', $subject->program_id)->orderBy('course_code','asc')->get();
        $prerequisites = Preqrequisite::where('subject_id', $subject->id)->get();
        $subjects = [];
        foreach($prerequisites as $prerequisite){
            $subject = Subject::where('id', $prerequisite->prerequisite_id)->first();
            $subjects[] = [
                'course_code' => $subject->course_code,
                'descriptive_title' => $subject->descriptive_title
            ];
        }

        return view('add-preqrequisite',[
            'programId' => $subject->program_id,
            'allSubjects' => $allSubjects,
            'prerequisites' => $subjects,
            'subject' => $chosenSubject,
            'user' => Auth::user()
        ]);
    }
    public function addCurriculumSubject(Request $request, Program $program){
        $fields = $request->validate([
            'course_code' => 'required',
            'descriptive_title' => 'required',
            'lab_units' => 'required',
            'lec_units' => 'required'
        ]);
        $fields['program_id'] = $program->id;
        $fields['year'] = $request->year;
        $fields['semester'] = $request->semester;

        $subject = Subject::create($fields);
        return redirect(route('manage-curriculum',$program->id));
    }

    public function addSubjectView(Program $program){
        return view('add-curriculum-subject',[
            'user' => Auth::user(),
            'program' => $program
        ]);
    }
    public function manageCurriculum(Program $program){

        function getPrerequisites($subjects){
            $subjectPrerequisites = [];
            
            foreach($subjects as $subject){
                $prerequisiteString = "";
                $prerequisites = Preqrequisite::where('subject_id', $subject->id)->get();
                if(count($prerequisites) == 0){
                    $prerequisiteString = "None";
                }else{

                    foreach($prerequisites as $prerequisite){
                        $subject = Subject::where('id', $prerequisite->prerequisite_id)->first();
                        $prerequisiteString .= $subject->course_code . ", ";
                    }
                }
                $subjectPrerequisites[] = $prerequisiteString;
            }

            return $subjectPrerequisites;
        }

        $user = Auth::user();

        $firstYearFirstSemesterSubjects = Subject::where('program_id',$program->id)->where('year','First Year')->where('semester','First Semester')->get();

        $firstYearFirstSemesterPrerequisites = getPrerequisites($firstYearFirstSemesterSubjects);

        $firstYearSecondSemesterSubjects = Subject::where('program_id',$program->id)->where('year','First Year')->where('semester','Second Semester')->get();

        $firstYearSecondSemesterPrerequisites = getPrerequisites($firstYearSecondSemesterSubjects);

        $secondYearFirstSemesterSubjects = Subject::where('program_id',$program->id)->where('year','Second Year')->where('semester','First Semester')->get();

        $secondYearFirstSemesterPrerequisites = getPrerequisites($secondYearFirstSemesterSubjects);

        $secondYearSecondSemesterSubjects = Subject::where('program_id',$program->id)->where('year','Second Year')->where('semester','Second Semester')->get();
        $secondYearSecondSemesterPrerequisites = getPrerequisites($secondYearSecondSemesterSubjects);

        $thirdYearFirstSemesterSubjects = Subject::where('program_id',$program->id)->where('year','Third Year')->where('semester','First Semester')->get();

        $thirdYearFirstSemesterPrerequisites = getPrerequisites(($thirdYearFirstSemesterSubjects));

        $thirdYearSecondSemesterSubjects = Subject::where('program_id',$program->id)->where('year','third Year')->where('semester','Second Semester')->get();
        $thirdYearSecondSemesterPrerequisites = getPrerequisites($thirdYearSecondSemesterSubjects);

        $fourthYearFirstSemesterSubjects = Subject::where('program_id',$program->id)->where('year','Fourth Year')->where('semester','First Semester')->get();

        $fourthYearFirstSemesterPrerequisites = getPrerequisites($fourthYearFirstSemesterSubjects);

        $fourthYearSecondSemesterSubjects = Subject::where('program_id',$program->id)->where('year','Fourth Year')->where('semester','Second Semester')->get();

        $fourthYearSecondSemesterPrerequisites = getPrerequisites($fourthYearSecondSemesterSubjects);
        return view('curriculum-management',[
            'firstYearFirstSemester' => $firstYearFirstSemesterSubjects,
            'firstYearFirstSemesterPrerequisites' => $firstYearFirstSemesterPrerequisites,
            'firstYearSecondSemester' => $firstYearSecondSemesterSubjects,
            'firstYearSecondSemesterPrerequisites' => $firstYearSecondSemesterPrerequisites,
            'secondYearFirstSemester' => $secondYearFirstSemesterSubjects,
            'secondYearFirstSemesterPrerequisites' => $secondYearFirstSemesterPrerequisites,
            'secondYearSecondSemester' => $secondYearSecondSemesterSubjects,
            'secondYearSecondSemesterPrerequisites' => $secondYearSecondSemesterPrerequisites,
            'thirdYearFirstSemester' => $thirdYearFirstSemesterSubjects,
            'thirdYearFirstSemesterPrerequisites' => $thirdYearFirstSemesterPrerequisites,
            'thirdYearSecondSemester' => $thirdYearSecondSemesterSubjects,
            'thirdYearSecondSemesterPrerequisites' => $thirdYearSecondSemesterPrerequisites,
            'fourthYearFirstSemester' => $fourthYearFirstSemesterSubjects,
            'fourthYearFirstSemesterPrerequisites' => $fourthYearFirstSemesterPrerequisites,
            'fourthYearSecondSemester' => $fourthYearSecondSemesterSubjects,
            'fourthYearSecondSemesterPrerequisites' => $fourthYearSecondSemesterPrerequisites,
            'program' => $program,
            'user' => $user
        ]);
    }
    public function programs(){
        $user = Auth::user();
        
        $programs = Program::all();

        return view('curriculum',[
            'programs' => $programs,
            'user' => $user
        ]);
    }
    public function createPrograms(){
        $programs = ['Bachelor of Science in Criminology','Bachelor of Science in Information Technology','Bachelor of Science in Pharmacy','Bachelor of Elementary Education','Bachelor of Secondary Education Major in English','Bachelor of Secondary Education Major in Math','Bachelor of Secondary Education Major in Filipino','Bachelor of Science in Accountancy','Bachelor of Science in Business Administration Major in Financial Management','Bachelor of Science in Business Administration Major in Marketing Management','Bachelor of Science in Hospitality Management','Bachelor of Science in Tourism Management'];

        $abbreviations = ['BSCRIM','BSIT','BSP','BEED','BSED English','BSED Math','BSED Filipino','BSA','BSBA Finman','BSBA Markman','BSHM','BSTM'];

        $fields = [];

        for($i=0;$i<12;$i++){

            $fields=[
                'program'=>$programs[$i],
                'abbreviation'=>$abbreviations[$i]
            ];
            Program::create($fields);
        }

       

        return response([

            'message' => 'ok'
        ]);
    }
}
