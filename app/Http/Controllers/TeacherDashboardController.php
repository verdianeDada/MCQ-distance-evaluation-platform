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

class Period {
    public $start_time;
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
        }])->orderBy('updated_at', 'desc')->get();
        
        foreach($testpapers as $key => $test){
            if (empty($test->course))
                unset($testpapers[$key]);
        }
       
        // look for teacher's taught courses

        $user = Auth::user();
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
            $min = explode(':',$request->duration);
                $timeRequired = 5400 + 60*(int)$min[1];

            // if is is not a common course
            if (!$course->isCommon)
            {
                $objectClassPapers = TestPaper::with(['course'=>function($query) use ($course){
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
                $classPapers = array();
                foreach($objectClassPapers as $test){
                    if (!empty($test->course))
                        array_push($classPapers, $test);
                }

                // look for gaps between classpapers
                
                
                if ((sizeof($classPapers)>0) && ($classPapers[0]->start_time != "08:00:00")){
                    $newtest = new Period;
                    $newtest->start = "07:45:00";
                    $newtest->end_time = "07:45:00";
                    array_unshift($classPapers, $newtest);

                }
                $goodplace = "";
                if (sizeof($classPapers)>1){
                    for($i=1; $i<sizeof($classPapers); $i++){
                        if ( (strtotime($classPapers[$i]->start_time) - strtotime($classPapers[$i-1]->end_time)) >= $timeRequired){
                            $goodplace = $classPapers[$i-1]->end_time;
                            break;
                        }               
                    }
                    if (empty($goodplace))
                        $goodplace = $classPapers[sizeof($classPapers)-1]->end_time;
                    
                }
                else if(sizeof($classPapers) == 1){
                    $goodplace = $classPapers[0]->end_time;
                }
                else{
                    $goodplace = "07:45:00";
                }

                $start_time = date('H:i:s',strtotime($goodplace)+900);
                $end_time = date('H:i:s',strtotime($start_time)+$timeRequired-1800);
                    


                // create testpaper
                if ( strtotime($end_time) <= strtotime("15:00:00")){
                    $testpaper = Testpaper::create([
                        "title"=> $request->title,
                        "date"=> $request->date,
                        "start_time"=> $start_time,
                        "end_time"=> $end_time,
                        "over_mark"=> $request->over_mark,
                        "course_id"=> $request->course_id,
                    ]);
                    if (!empty($request->questions)){
                        foreach($request->questions as $question){
                            $actualQuestion = Question::create([
                                "text" => $question['text'],
                                "over_mark" => $question['over_mark'],
                                "test_paper_id"=> $testpaper->id,
                            ]);
                            foreach ($question['distractors'] as $distractor){
                                $is_correct = false;
                                if ($question['is_correct'] == $distractor['index']){
                                    $is_correct = true;
                                }
                                QuestionDistractor::create([
                                    'text' => $distractor['text'],
                                    'question_id' => $actualQuestion->id,
                                    'isCorrect' => $is_correct
                                ]);
                            }
                        }
                    }
                    return TestPaper::where('id','=', $testpaper->id)->with(['course'])->get()[0];
                }
                else
                    return ['problem'=>"Please choose another day, this one is full"];

            }




            else{
                //ICT papers

                $ICTPapers_o = TestPaper::with(['course'=>function($query) use ($course){
                    $query->where([
                            ['courses.option','=',1],
                            ['courses.year','=',$course->year]
                            ])
                        ->orWhere([
                            ['courses.isCommon','=',1],
                            ['courses.year','=',$course->year]
                            ]);
                }])->where('date','=',$request->date)
                    ->orderBy('start_time', 'asc')->get(); 
                // removing null values

                $ICTPapers = array();
                foreach($ICTPapers_o as $test){
                    if (!empty($test->course))
                        array_push($ICTPapers, $test);
                }
                 
                //FCS papers

                 $FCSPapers_o = TestPaper::with(['course'=>function($query) use ($course){
                    $query->where([
                            ['courses.option','=',0],
                            ['courses.year','=',$course->year]
                            ])
                        ->orWhere([
                            ['courses.isCommon','=',1],
                            ['courses.year','=',$course->year]
                            ]);
                }])->where('date','=',$request->date)
                    ->orderBy('start_time', 'asc')->get(); 
                
                    // removing null values

                $FCSPapers = array();
                foreach($FCSPapers_o as $test){
                    if (!empty($test->course))
                        array_push($FCSPapers, $test);
                }   
                // free periods  for ICT

                $freePeriodICT = array();
                if ((sizeof($ICTPapers)>0) && ($ICTPapers[0]->start_time != "08:00:00")){
                    $period = new Period;
                    $period->start_time = "07:45:00";
                    $period->end_time = $ICTPapers[0]->start_time;
                    array_unshift($freePeriodICT, $period);
                }
                if (sizeof($ICTPapers)>1){
                    for($i=1; $i<sizeof($ICTPapers); $i++){
                        if ((strtotime($ICTPapers[$i]->start_time) - strtotime($ICTPapers[$i-1]->end_time)) >= $timeRequired){
                            $period = new Period;
                            $period->start_time = date('H:i:s', strtotime($ICTPapers[$i-1]->end_time));
                            $period->end_time = date('H:i:s', strtotime($ICTPapers[$i]->start_time));
                            array_push($freePeriodICT, $period);
                        }           
                    }
                    if (strtotime($ICTPapers[$i-1]->end_time) < strtotime("15:00:00"))
                    {   
                        $period = new Period;
                        $period->start_time = $ICTPapers[$i-1]->end_time;
                        $period->end_time = "15:00:00";
                        array_push($freePeriodICT, $period);
                    }
                        
                }
                else if(sizeof($ICTPapers) == 1){
                    $period = new Period;
                    $period->start_time = $ICTPapers[0]->end_time;
                    $period->end_time = "15:00:00";
                    array_push($freePeriodICT, $period);
                }
                else{
                    $period = new Period;
                    $period->start_time = "07:45:00";
                    $period->end_time = "15:00:00";
                    array_push($freePeriodICT, $period);
                }

                // free periods  for FCS

                $freePeriodFCS = array();
                if ((sizeof($FCSPapers)>0) && ($FCSPapers[0]->start_time != "08:00:00")){
                    $period = new Period;
                    $period->start_time = "07:45:00";
                    $period->end_time = $FCSPapers[0]->start_time;
                    array_unshift($freePeriodFCS, $period);
                }
                if (sizeof($FCSPapers)>1){
                    for($i=1; $i<sizeof($FCSPapers); $i++){
                        if ((strtotime($FCSPapers[$i]->start_time) - strtotime($FCSPapers[$i-1]->end_time)) >= $timeRequired){
                            $period = new Period;
                            $period->start_time = date('H:i:s', strtotime($FCSPapers[$i-1]->end_time));
                            $period->end_time = date('H:i:s', strtotime($FCSPapers[$i]->start_time));
                            array_push($freePeriodFCS, $period);
                        }           
                    }
                    if (strtotime($FCSPapers[$i-1]->end_time) < strtotime("15:00:00"))
                    {   
                        $period = new Period;
                        $period->start_time = $FCSPapers[$i-1]->end_time;
                        $period->end_time = "15:00:00";
                        array_push($freePeriodFCS, $period);
                    }
                        
                }
                else if(sizeof($FCSPapers) == 1){
                    $period = new Period;
                    $period->start_time = $FCSPapers[0]->end_time;
                    $period->end_time = "15:00:00";
                    array_push($freePeriodFCS, $period);
                }
                else{
                    $period = new Period;
                    $period->start_time = "07:45:00";
                    $period->end_time = "15:00:00";
                    array_push($freePeriodFCS, $period);
                }
                // look for common free time 
                $goodplace = "";
                foreach($freePeriodFCS as $keyF => $fcs){
                    foreach($freePeriodICT as $keyI => $ict){
                        if (  ( strtotime($freePeriodFCS[$keyF]->end_time) > strtotime($freePeriodICT[$keyI]->start_time) ) && 
                              ( strtotime($freePeriodFCS[$keyF]->start_time) < strtotime($freePeriodICT[$keyI]->end_time) )
                            ){
                            $period = new Period;
                            $period->start_time =  max( strtotime($freePeriodFCS[$keyF]->start_time) , strtotime($freePeriodICT[$keyI]->start_time));
                            $period->end_time = min( strtotime($freePeriodFCS[$keyF]->end_time) , strtotime($freePeriodICT[$keyI]->end_time));
                            if ( ($period->end_time - $period->start_time) >= $timeRequired ){
                                $goodplace = date("H:i:s", $period->start_time);
                                break;
                            }
                        }
                    }
                    if(!empty($goodplace))
                        break;
                }

                // create testpaper


                
                if (!empty($goodplace)){
                        $start_time = date('H:i:s',strtotime($goodplace)+900);
                        $end_time = date('H:i:s',strtotime($start_time)+$timeRequired-1800);
                        $testpaper = Testpaper::create([
                            "title"=> $request->title,
                            "date"=> $request->date,
                            "start_time"=> $start_time,
                            "end_time"=> $end_time,
                            "over_mark"=> $request->over_mark,
                            "course_id"=> $request->course_id,
                        ]);
    
                    if (!empty($request->questions)){
                    foreach($request->questions as $question){
                        $actualQuestion = Question::create([
                            "text" => $question['text'],
                            "over_mark" => $question['over_mark'],
                            "test_paper_id"=> $testpaper->id,
                        ]);
                        foreach ($question['distractors'] as $distractor){
                            $is_correct = false;
                            if ($question['is_correct'] == $distractor['index']){
                                $is_correct = true;
                            }
                            QuestionDistractor::create([
                                'text' => $distractor['text'],
                                'question_id' => $actualQuestion->id,
                                'isCorrect' => $is_correct
                            ]);
                        }
                    }}
                    
                    return TestPaper::where('id','=', $testpaper->id)->with(['course'])->get()[0];
                }
                else
                    return ['problem'=>"FCS & ICT do not have common free time this day! Please choose another one"];


                // look ,for a common free period

                
              
            }
                
        }

        catch(\Exception $e){  return $e->getMessage();}
       
    }

    public function delete_testpaper($id){
        try{
            $testpaper = TestPaper::where('id',$id)->get()[0];
            $questions = $testpaper->questions;
            foreach($questions as $quest){
                $distractors = $quest->question_distractors;
                foreach($distractors as $dist){
                    QuestionDistractor::destroy($dist->id);
                }
                Question::destroy($quest->id);
            }
            TestPaper::destroy($testpaper->id);
            return $testpaper;
        }
        catch(\Exception $e){  return $e->getMessage();}
    }

   

    public function set_update_testpaper($id){
        try{
            $testpaper = TestPaper::where('id',$id)->with(['questions'])->orderBy('updated_at', 'desc')->get()[0];
            
            foreach($testpaper->questions as $keyQ => $quest){
                $testpaper->questions[$keyQ]->distractors = $quest->question_distractors;
                foreach($quest->distractors as $keyD => $dist){
                    if($dist->isCorrect){
                        $testpaper->questions[$keyQ]->is_correct = $keyD;
                    }
                }
            }
            $testpaper->duration = date("H:i", strtotime($testpaper->end_time)-strtotime($testpaper->start_time));
            return $testpaper;
    }
    catch(\Exception $e){
          return $e->getMessage();
    } 
}
    
    public function update_testpaper(Request $request){
         $this->delete_testpaper($request->id);
        return $this->create_testpaper($request);

    }

} ;