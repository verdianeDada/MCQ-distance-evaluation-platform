<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\TestPaper;
use App\User;
use App\Question;
use App\QuestionDistractor;
use App\Course;
// Define our class.
class Test {
    // Define the properties.
    public $end_time;
  }
  
class TeacherDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // look for testpapers

        $userid = Auth::user()->id;

        $testpapers = TestPaper::with(['course'=>function($query) use ($userid){
            $query->where('user_id','=', $userid);
        }])->orderBy('start_time', 'asc')->get();
        
        foreach($testpapers as $key => $test){
            if (empty($test->course))
                unset($testpapers[$key]);
        }
       
        // look for teacher's taught courses

        $user = User::find($userid);
        $courses = $user->courses()
            ->orderBy('year', 'asc')->get();
            
        foreach($courses as $course) {
            if ($course->isCommon)
                $course->option="FCS & ICT";
            else{
                if ($course->option)
                    $course->option = "ICT";
                else
                    $course->option="FCS";
            }
        }
        
        return ['courses'=>$courses,'testpapers'=>$testpapers];
    }

    // test papers

    public function create_testpaper(Request $request)
    {
        try{
           
            //testpapers scheduled on the date choosen
            $course = Course::where('id','=',$request->course_id)->get()[0];
            // if is is not a common course
            if (!$course->isCommon)
            {
                $classPapers = TestPaper::with(['course'=>function($query) use ($course){
                    $query->where([
                            ['courses.option','=',$course->option],
                            ['courses.year','=',$course->year]
                            ])
                        ->orWhere([
                            ['courses.isCommon','=',1],
                            ['courses.year','=',$course->year]
                            ]);
                }])->where('date','=',$request->date)
                    ->orderBy('start_time', 'asc')->get();

                //cleaning null courses
                $arrayClassPapers = array();
                foreach($classPapers as $key => $test){
                    if (empty($test->course))
                        unset($classPapers[$key]);
                    else
                        array_push($arrayClassPapers, $test);
                }

                // look for gaps between classpapers
                $min = explode(':',$request->duration);
                $timeRequired = 7200 + 60*(int)$min[1];
                
                if ($arrayClassPapers[0]->start_time != "07:00:00"){
                    $newtest = new Test();
                    $newtest->end_time = "06:30:00";
                    array_unshift($arrayClassPapers, $newtest);
                }
                if (sizeof($arrayClassPapers)>=1){
                    for($i=1; $i<sizeof($arrayClassPapers); $i++){
                        $gap = strtotime($arrayClassPapers[$i]->start_time) - strtotime($arrayClassPapers[$i-1]->end_time);
                        if ($gap >= $timeRequired){
                            $goodplace = $arrayClassPapers[$i-1]->end_time;
                            break;
                        }               
                    }
                }
                else if(sizeof($arrayClassPapers) == 1)
                    $goodplace = $arrayClassPapers[0];
                else
                    $goodplace = "06:30:00";

                if (empty($goodplace)){
                    $goodplace = $arrayClassPapers[$i-1]->end_time;
                   
                }

                $start_time = date('H:i:s',strtotime($goodplace)+1800);
                $end_time = strtotime($start_time)+$timeRequired-3600;
                    
                if ( $end_time <= strtotime("16:00:00")){
                    echo "have been done in rhis day   ".$start_time;
                    return Testpaper::create([
                        "title"=> $request->title,
                        "date"=> $request->date,
                        "start_time"=> $start_time,
                        "end_time"=> date('H:i:s',$end_time),
                        "over_mark"=> $request->over_mark,
                        "course_id"=> $request->course_id,
                    ]);
                }
                else
                    return "the day is full, choose anothe rone";

                
                

                // if (!empty($request->questions)){
                // foreach($request->questions as $question){
                //     $actualQuestion = Question::create([
                //         "text" => $question['text'],
                //         "over_mark" => $question['over_mark'],
                //         "test_paper_id"=> $testpaper->id,
                //     ]);
                //     foreach ($question['distractors'] as $distractor){
                //         $is_correct = false;
                //         if ($question['is_correct'] == $distractor['index']){
                //             $is_correct = true;
                //         }
                //         QuestionDistractor::create([
                //             'text' => $distractor['text'],
                //             'question_id' => $actualQuestion->id,
                //             'isCorrect' => $is_correct
                //         ]);
                //     }
                // }}
                // $testpaperid = $testpaper->id;
                
                // return TestPaper::where('id','=', $testpaper->id)->with(['course'])->get();
            }
            else
                return "is a common course";
        }

        catch(\Exception $e){  return $e->getMessage();}
       
    }

} ;