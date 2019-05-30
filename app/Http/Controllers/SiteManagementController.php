<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Course;
use App\User;

class SiteManagementController extends Controller
{
    public function index(){
        return view('site_management');
    }
    public function loadpage(){
        $courses = DB::table('courses')->orderBy('code')->get();
        $users = DB::table('users')->orderBy('matricule')->get();
        return ['courses' =>$courses, 'users' => $users];
    }
}

