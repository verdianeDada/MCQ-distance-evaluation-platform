<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index(){
        $hod = DB::table('staff')->where('type', '=', 'hod')->orderBy('name','asc')->get();
         $hoo = DB::table('staff')->where('type', '=', 'hoo')->orderBy('name','asc')->get();
         $teacher = DB::table('staff')->where('type', '=', 'teacher')->orderBy('name','asc')->get();
         $delegate = DB::table('staff')->where('type', '=', 'delegate')->orderBy('name','asc')->get();
         $news = DB::table('news')->orderBy('updated_at','desc')->get();
         return view('welcome', compact("hod","hoo","delegate","teacher","news"));
    }
}
