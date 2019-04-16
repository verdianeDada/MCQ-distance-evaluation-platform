<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\TestPaper;
use App\User;
use App\Question;
use App\QuestionDistractor;

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
            $testpaper = Testpaper::create([
                "title"=> $request->title,
                "start_time"=> $request->start_time,
                "over_mark"=> $request->over_mark,
                "course_id"=> $request->course_id,
                "duration"=> $request->duration
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
            $testpaperid = $testpaper->id;
            
            return TestPaper::where('id','=', $testpaper->id)->with(['course'])->get();
        }

        catch(\Exception $e){  return $e->getMessage();}
       
    }

} ;