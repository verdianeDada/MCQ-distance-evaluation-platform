<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\TestPaper;
use App\User;
// use App\Question;
// use App\QuestionDistractor;
use App\Course;

class StudentDashboardController extends Controller
{
    public function index()
    {
        try{
            // look for testpapers
            $userid = Auth::user()->id;
            $user = Auth::user();

            $repeatingCourses = $user->course_repeat()->orderBy('code')->get();
            $courses = Course::where([
                            ['year',$user->year],
                            ['option',$user->option],
                        ])
                        ->orWhere([
                            ["year", $user->year],
                            ["isCommon", 1]
                        ])->orderBy('code')->get();

            //testpapers
            $now = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s"))+3600);

            $testpapers_o = TestPaper::with(['course'=>function($query) use ($user){
                $query->where([
                    ['courses.year', $user->year],
                    ['courses.option', $user->option],
                ])
                ->orWhere([
                    ["courses.year", $user->year],
                    ["courses.isCommon", 1]
                ]);
            }])->orderBy('updated_at', 'desc')->get();
            $testpapers = array();
            $todayTestpapers = array();
            foreach($testpapers_o as $key => $test){
                if ( !empty($test->course)){
                    if (strtotime($test->date.' '.$test->end_time) > strtotime($now) ){
                        $test->obsolete = false;
                    }
                    else 
                        $test->obsolete = true;
                    array_push($testpapers, $test);
                    
                    if ($test->date == date("Y-m-d", strtotime($now)))
                    array_push($todayTestpapers, $test);

                }
            }
            
            //repeating testpapers
            
           $repeatingTestpapers = array();
           foreach($repeatingCourses as $key=>$rc){
                $temp = Testpaper::with(['course'])->where('course_id',$rc->id)->get();
                if ( sizeof($temp)>0){
                    if (strtotime($temp[0]->date.' '.$temp[0]->end_time) > strtotime($now) ){
                        $temp[0]->obsolete = false;                        
                    }
                    else 
                        $temp[0]->obsolete = true;
                    array_push($repeatingTestpapers, $temp[0]);

                    if ($temp[0]->date == date("Y-m-d", strtotime($now)))
                            array_push($todayTestpapers, $temp[0]);
                }
           }
           
            return [
                'courses'=>$courses,
                'testpapers'=>$testpapers, 
                'repeatingCourses'=>$repeatingCourses, 
                'repeatingTestpapers'=>$repeatingTestpapers,
                'todayTestpapers'=>$todayTestpapers
            ];
        }
        catch(\Exception $e){
           return $e->getMessage();
        }
    }
    
}
