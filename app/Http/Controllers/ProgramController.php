<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\Preqrequisite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Database\Query\Builder;

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
            $prerequisites = Subject::where(function(Builder $query){
                $query->where('year','First Year')->orWhere('year','Second Year');
            })->where('program_id',$subject->program_id)->get();
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
        $allSubjects = Subject::where('program_id', $subject->program_id)->where('id','<>',$chosenSubject->id)->orderBy('course_code','asc')->get();
        $prerequisites = Preqrequisite::where('subject_id', $subject->id)->get();
        $subjects = [];
        foreach($prerequisites as $prerequisite){
            $subject = Subject::where('id', $prerequisite->prerequisite_id)->first();
            $subjects[] = [
                'course_code' => $subject->course_code,
                'descriptive_title' => $subject->descriptive_title
            ];
        }
        $program = Program::where('id', $subject->program_id)->first();

        return view('add-preqrequisite',[
            'program' => $program,
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

        $yearArray = explode('-',$request->year);
        $fields['program_id'] = $program->id;
        $fields['year'] = $yearArray[0];
        $fields['semester'] = $request->semester;
        $fields['numeric_year'] = $yearArray[1];

        $subject = Subject::create($fields);
        return redirect(route('manage-curriculum',$program->id));
    }

    public function addSubjectView(Program $program){
        return view('add-curriculum-subject',[
            'user' => Auth::user(),
            'program' => $program
        ]);
    }
    public function deleteSubject(Subject $subject){

        Preqrequisite::where('subject_id', $subject->id)->delete();
        $courseCode = $subject->course_code;
        $subject->delete();
        return back()->with([
            'message' => $courseCode . ' has been deleted.'
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
                        if($subject){

                            $prerequisiteString .= $subject->course_code . ", ";
                        }
                    }
                }
                $subjectPrerequisites[] = $prerequisiteString;
            }

            return $subjectPrerequisites;
        }

        $semesters = [];

        $programSubjects = Subject::where('program_id', $program->id)->orderBy('numeric_year','asc')->orderBy('semester','asc')->get();
        $currentYear = "";
        $currentSemester = "";
        foreach($programSubjects as $subject){
            if($subject->year != $currentYear || $currentSemester != $subject->semester){
                $semesters[] = [
                    'year' => $subject->year,
                    'semester' => $subject->semester
                ];
                $currentYear = $subject->year;
                $currentSemester = $subject->semester;
            }
        }


        $curriculumData = [];
        foreach($semesters as $semester){
            $subjects = Subject::where('year', $semester['year'])->where('semester', $semester['semester'])->where('program_id', $program->id)->get();
            
            $prerequisites = getPrerequisites($subjects);
            $curriculumData[] = [
                'year' => $semester['year'],
                'semester' => $semester['semester'],
                'subjects' => $subjects,
                'prerequisites' => $prerequisites
            ];
        }
        $user = Auth::user();

        return view('curriculum-management',[
            'user' => $user,
            'program' => $program,
            'curriculumData' => $curriculumData
        ]);
    }
    public function programs(){
        $user = Auth::user();
        
        $programs = Program::orderBy('program','asc')->get();

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
