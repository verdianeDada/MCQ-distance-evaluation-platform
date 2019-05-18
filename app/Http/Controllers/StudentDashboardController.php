<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\TestPaper;
use App\User;
use App\WrittenTestPaper;
use App\RepeatingCourse;
use App\Course;

class StudentDashboardController extends Controller
{
    public function index()
    {
        try{
            // look for testpapers
            $userid = Auth::user()->id;
            $user = Auth::user();

            $temp = RepeatingCourse::where('user_id', $userid)->get();
            $repeatingCourses = array();
            if (!empty($temp)){
                foreach($temp as $rc){
                    array_push($repeatingCourses, Course::where('id', $rc->course_id)->get()[0]);
                }
            }
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
                    else {
                        $test->obsolete = true;
                        $temp = WrittenTestPaper::where([['user_id', Auth::user()->id], ['test_paper_id', $test->id]])->get();
                        if (sizeof($temp) != 0)
                            $test->mark_obtained = $temp[0]->over_mark;
                        else    
                        $test->mark_obtained = 0;
                    }
                    array_push($testpapers, $test);
                    
                    if ($test->date == date("Y-m-d", strtotime($now))){
                        $temp = WrittenTestPaper::where([['user_id', Auth::user()->id], ['test_paper_id', $test->id]])->get();
                                if (sizeof($temp) != 0)
                                    $test->done = true;
                                else    
                                    $test->done = false;
                        array_push($todayTestpapers, $test);
                    }

                }
            }
            
            //repeating testpapers
            $repeatingTestpapers = array();

            if (!empty($repeatingCourses)){
                foreach($repeatingCourses as $rc){
                        $test = Testpaper::with(['course'])->where('course_id',$rc->id)->get();
                        if ( sizeof($test)>0){
                            if (strtotime($test[0]->date.' '.$test[0]->end_time) > strtotime($now) ){
                                $test[0]->obsolete = false;                        
                            }
                            else {
                                $test[0]->obsolete = true;
                                $temp = WrittenTestPaper::where([['user_id', Auth::user()->id], ['test_paper_id', $test[0]->id]])->get();
                                if (sizeof($temp) != 0)
                                    $test[0]->mark_obtained = $temp[0]->over_mark;
                                else    
                                    $test[0]->mark_obtained = 0;
                            }
                            array_push($repeatingTestpapers, $test[0]);

                            if ($test[0]->date == date("Y-m-d", strtotime($now))){
                                $temp = WrittenTestPaper::where([['user_id', Auth::user()->id], ['test_paper_id', $test[0]->id]])->get();
                                if (sizeof($temp) != 0)
                                    $test[0]->done = true;
                                else    
                                    $test[0]->done = false;
                                array_push($todayTestpapers, $test[0]);

                            }
                        }
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
