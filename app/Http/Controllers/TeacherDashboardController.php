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
use PDF;
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
        $now = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s"))+3600);


        $testpapers = TestPaper::with(['course'=>function($query) use ($userid){
            $query->where('user_id','=', $userid);
        }])->orderBy('updated_at', 'desc')->get();
        
        if (sizeof($testpapers) > 0){
            foreach($testpapers as $key => $test){
                if (empty($test->course))
                    unset($testpapers[$key]);
                else{
                    if (strtotime($test->date.' '.$test->end_time) < strtotime($now) ){
                        $testpapers[$key]->obsolete = true;
                    }
                }
            }
        }
       
        // look for teacher's taught courses

        $user = Auth::user();
        $courses = $user->courses()
            ->orderBy('year', 'asc')->get();
        if (sizeof($courses) > 0){
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
                if (sizeof($objectClassPapers)){
                    foreach($objectClassPapers as $test){
                        if (!empty($test->course))
                            array_push($classPapers, $test);
                    }
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
                        $distractorsData = array();
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
                                array_push($distractorsData, [
                                    'text' => $distractor['text'],
                                    'question_id' => $actualQuestion->id,
                                    'isCorrect' => $is_correct
                                ]);
                            }
                        }
                        DB::table('question_distractors')->insert($distractorsData);
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
                if (sizeof($ICTPapers_o)){
                    foreach($ICTPapers_o as $test){
                        if (!empty($test->course))
                            array_push($ICTPapers, $test);
                    }
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
                if (sizeof($FCSPapers)){
                    foreach($FCSPapers_o as $test){
                        if (!empty($test->course))
                            array_push($FCSPapers, $test);
                    }   
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
                if (sizeof($freePeriodFCS)){
                    foreach($freePeriodFCS as $keyF => $fcs){
                        if (sizeof($freePeriodICT) > 0){
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
                        }
                        if(!empty($goodplace))
                            break;
                    }
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
                        $distractorsData = array();
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
                                array_push($distractorsData, [
                                    'text' => $distractor['text'],
                                    'question_id' => $actualQuestion->id,
                                    'isCorrect' => $is_correct
                                ]);
                            }
                        }
                        DB::table('question_distractors')->insert($distractorsData);
                   
                    }
                    
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
            $questions_id = array();
            if (sizeof($questions) > 0){
                foreach ($questions as $quest){
                    array_push($questions_id, $quest->id);
                }
            }
             DB::table('questions')->whereIn('id', $questions_id)->delete();
             DB::table('question_distractors')->whereIn('question_id', $questions_id)->delete();
            TestPaper::destroy($testpaper->id);

            return;
        }
        catch(\Exception $e){  return $e->getMessage();}
    }

   

    public function set_update_testpaper($id){
        try{
            $testpaper = TestPaper::where('id',$id)->with(['questions.distractors'])->orderBy('updated_at', 'desc')->get();
            if (sizeof($testpaper) > 0 && sizeof($testpaper[0]->questions) > 0){
                foreach($testpaper[0]->questions as $keyQ => $quest){
                    if (sizeof($testpaper[0]->questions[$keyQ]->distractors) > 0){
                        foreach($quest->distractors as $keyD => $dist){
                            if($dist->isCorrect){
                                $testpaper[0]->questions[$keyQ]->is_correct = $keyD;
                            }
                        }
                    }
                }
                $testpaper[0]->duration = date("H:i", strtotime($testpaper[0]->end_time)-strtotime($testpaper[0]->start_time));
                return $testpaper[0];
            }
        }
        catch(\Exception $e){
            return $e->getMessage();
        } 
}
    
    public function update_testpaper(Request $request){
         $this->delete_testpaper($request->id);
        return $this->create_testpaper($request);

    }

    public function testpaper_results($id){
        if (Auth::user()->isTeacher){
            
            $testpaper = TestPaper::where('id',$id)->with(['course'])->get();
            if (sizeof($testpaper)> 0 && $testpaper[0]->course->user_id == Auth::user()->id){
                $testpaper = $testpaper[0];
                $teacher = Auth::user();
                
                $users_o =  User::with(['user_written_papers' => function($query) use($id){
                    $query->where('test_paper_id', $id);
                }])->orderBy('matricule')->get();

                
                if (!$testpaper->course->isCommon){
                    $users = array();
                    if ($testpaper->course->option == 0)
                        $testpaper->course->option = 'FCS';
                    else
                        $testpaper->course->option = 'ICT';
                }
                else{
                    $testpaper->course->option = 'FCS & ICT';
                
                    $fcsUsers = array();
                    $ictUsers = array();
                }
                if ( sizeof($users_o) > 0){
                    foreach ($users_o as $user){
                        if (sizeof($user->user_written_papers) > 0){
                            if ($user->user_written_papers[0]->pivot->mark_obtained < 10){
                                $user->user_written_papers[0]->pivot->mark_obtained = (int) '0'.$user->user_written_papers[0]->pivot->mark_obtained;
                            }
                            if ($testpaper->course->isCommon){
                                if ($user->option)
                                    array_push($ictUsers, $user);
                                else 
                                    array_push($fcsUsers, $user);
                            }
                            else 
                                array_push($users, $user);
                        }
                    }
                }
                // view()->share('users',$users);
                $now = date("Y-m-d H:i",strtotime(date("Y-m-d H:i"))+3600);
                if ($testpaper->course->isCommon)
                    $data = [
                         'testpaper' => $testpaper, 
                         'teacher' => $teacher, 
                         'ictUsers' => $ictUsers, 
                         'fcsUsers' => $fcsUsers,
                         'now' => $now,
                        ];
                else
                    $data = [
                        'testpaper' => $testpaper, 
                        'teacher' => $teacher, 
                        'users' => $users,
                        'now' => $now
                    ];
                    
                PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
                $pdf = PDF::loadView('results', $data);

                return $pdf->download($testpaper->course->code.' '.$testpaper->title.'.pdf');
            }
            else{ 
                $error = "This test paper is'nt yours!";
                return view('pagenotfound', compact('error'));
            }
        }
        else{
            $error = "You are not a teacher";
            return view('pagenotfound', compact('error'));
        } 
       
    }

} ;