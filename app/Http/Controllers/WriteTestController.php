<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Testpaper;

class WriteTestController extends Controller
{
    public function index(){
        return view('write_test');
    }
    
    public function set_test(){
        try {
            $user = Auth::user();
            $now = strtotime(date("Y-m-d H:i:s"))+3600;

            $actualTest = TestPaper::with(['course'=>function($query) use ($user, $now){
                $query->where([
                    ['courses.year', $user->year],
                    ['courses.option', $user->option]
                ])
                ->orWhere([
                    ["courses.year", $user->year],
                    ["courses.isCommon", 1]
                ]);
            }])->where([
                ['date', date("Y-m-d", $now)],
                ['start_time','<=',date("H:i:s", $now)],
                ['end_time','>',date("H:i:s", $now)]
            ])->get();

            
            foreach($actualTest as $key => $test){
                if (empty($test->course))
                    unset($actualTest[$key]);
            }

            if (empty($actualTest[0]))
                return [ "error"=>"no-test"];
            else{

                $course = $actualTest[0]->course;
                if ($course->isCommon)
                    $course->option="FCS & ICT";
                else{
                    if ($course->option)
                        $course->option = "ICT";
                    else
                        $course->option="FCS";
                }
                
                
                $actualTest = TestPaper::where('id',$actualTest[0]->id)->with(['questions'])->orderBy('updated_at', 'desc')->get()[0];
                $actualTest->start_datetime = Date("M j,Y", strtotime($actualTest->date))." ".$actualTest->start_time;
                $actualTest->end_datetime = Date("M j,Y", strtotime($actualTest->date))." ".$actualTest->end_time;
                foreach($actualTest->questions as $keyQ => $quest){
                    $actualTest->questions[$keyQ]->distractors = $quest->question_distractors;
                }
                //clear correct answers
                foreach($actualTest->questions as $keyQ=> $quest){
                    foreach($actualTest->questions[$keyQ]->distractors as $keyD=> $dist){
                        $actualTest->questions[$keyQ]->distractors[$keyD]->isCorrect = "";
                    }
                }
                $actualTest->duration = date("H:i", strtotime($actualTest->end_time)-strtotime($actualTest->start_time));
                return ["actualTest"=>$actualTest, "course"=>$course , "user"=>Auth::user()];
            }
        }
        catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
