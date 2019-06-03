<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\TestPaper;
use App\Question;
use App\RepeatingCourse;
use App\Course;
use App\WrittenTestPaper;

class WriteTestController extends Controller
{
    public function index(){
        if (!Auth::user()->isTeacher )
            return view('write_test');
        else{
            $error = "You are not a student";
            return view('pagenotfound', compact('error'));
        } 
    }
    
    public function set_test(){
        try {
            $user = Auth::user();
            $now = strtotime(date("Y-m-d H:i:s"))+3600;
            $test = TestPaper::with(['course'=>function($query) use ($user, $now){
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
            ])->with(['questions.distractors'])->get();
        
            $actualTest = "no-test";
            if (sizeof($test) > 0){
                foreach($test as $key => $t){
                    if (sizeof($t->course) > 0){
                        $actualTest = $test[$key];
                        break;
                    }
                }
            }
            if ($actualTest == "no-test"){
                // look for repeating test and courses
                $repeatingCourses = RepeatingCourse::where('user_id', $user->id)->get();
                if (sizeof($repeatingCourses) > 0){
                    $repeatingCoursesId = array();
                    foreach($repeatingCourses as $rc){
                        array_push($repeatingCoursesId, $rc->course_id);
                    }
                    $temp = TestPaper::whereIn('course_id', $repeatingCoursesId)->where([
                            ['date', date("Y-m-d", $now)],
                            ['start_time','<=',date("H:i:s", $now)],
                            ['end_time','>',date("H:i:s", $now)]
                            ])->with(['questions.distractors','course'])->orderBy('updated_at', 'desc')->get();
                    if (sizeof($temp) > 0 ){
                        $actualTest = $temp[0];
                        $course = $temp[0]->course;
                        if ($course->isCommon)
                            $course->option="FCS & ICT";
                        else{
                            if ($course->option)
                                $course->option = "ICT";
                            else
                                $course->option="FCS";
                        } 
                    }
                }
                if ($actualTest == "no-test"){
                    return [ "error"=>"Sorry, there is not a Test paper that has been scheduled at this time"];
                }
                else{
                    $testDone = DB::table('written_test_papers')->where([['user_id', $user->id],['test_paper_id', $actualTest->id]])->get();
                    if (sizeof($testDone) > 0){
                        return [ "error"=>"Sorry, You have already written this particular test paper"];
                    }
                    else{
                        $actualTest->start_datetime = Date("M j,Y", strtotime($actualTest->date))." ".$actualTest->start_time;
                        $actualTest->end_datetime = Date("M j,Y", strtotime($actualTest->date))." ".$actualTest->end_time;
                       
                        foreach($actualTest->questions as $keyQ=> $quest){
                            $actualTest->questions[$keyQ]->number = $keyQ + 1;
                            foreach($actualTest->questions[$keyQ]->distractors as $keyD=> $dist){
                                $actualTest->questions[$keyQ]->distractors[$keyD]->isCorrect = 0;
                            }
                        }
                        $actualTest->duration = date("H:i", strtotime($actualTest->end_time)-strtotime($actualTest->start_time));

                        return ["actualTest"=>$actualTest, "course"=>$course , "user"=>Auth::user()];
                    }
                }
            }
            else{
                $testDone ='';
                $testDone = DB::table('written_test_papers')->where([['user_id', $user->id],['test_paper_id', $actualTest->id]])->get();
                if (sizeof($testDone) > 0){
                    return [ "error"=>"Sorry, You have already written this particular test paper"];
                }
                else{
                    $course = $actualTest->course;
                    if ($course->isCommon)
                        $course->option="FCS & ICT";
                    else{
                        if ($course->option)
                            $course->option = "ICT";
                        else
                            $course->option="FCS";
                    }                    
                    
                    $actualTest->start_datetime = Date("M j,Y", strtotime($actualTest->date))." ".$actualTest->start_time;
                    $actualTest->end_datetime = Date("M j,Y", strtotime($actualTest->date))." ".$actualTest->end_time;

                    //clear correct answers
                    foreach($actualTest->questions as $keyQ=> $quest){
                        $actualTest->questions[$keyQ]->number = $keyQ + 1;
                        foreach($actualTest->questions[$keyQ]->distractors as $keyD=> $dist){
                            $actualTest->questions[$keyQ]->distractors[$keyD]->isCorrect = 0;
                        }
                    }
                    $actualTest->duration = date("H:i", strtotime($actualTest->end_time)-strtotime($actualTest->start_time));
                    return ["actualTest"=>$actualTest, "course"=>$course , "user"=>Auth::user()];
                }
            }
        }
        catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function submit_test(Request $request){
        try{
            $written = WrittenTestpaper::where('test_paper_id', $request->id)->get();

            if (sizeof($written) > 0){
                 return [ "error"=>"Sorry, You have already written this particular test paper"];
            }
            else{

                $test = TestPaper::where('id',$request->id)->with(['questions.distractors'])->orderBy('updated_at', 'desc')->get()[0];
            
                $DBquestions = $test->questions;
                $totalMark = 0;
                foreach($request->questions as $keyQ=>$quest){
                    foreach($DBquestions[$keyQ]->distractors as $disQ){
                        if ($disQ->isCorrect == 1){
                            foreach($quest['distractors'] as $dis){
                                    if ( ($dis['isCorrect'] == $disQ->isCorrect) && ($dis['id'] == $disQ->id) ){
                                        $totalMark = $totalMark + $DBquestions[$keyQ]->over_mark;
                                    }
                            }
                        }
                    }
                }
                return WrittenTestPaper::create([
                    'user_id' =>Auth::user()->id,
                    'test_paper_id' => $request['id'],
                    'over_mark' => $totalMark,
                ]);
                return $totalMark;
            }
        }
        catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
