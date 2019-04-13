<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\TestPaper;
use App\User;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_testpaper(Request $request)
    {
        return 'makkk'.$request;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
