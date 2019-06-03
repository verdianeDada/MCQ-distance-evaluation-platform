<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\News;
use App\Staff;

class NewStaffController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index()
    {
        if (Auth::user()->isAdmin )
            return view('newstaff');
        else{
            $error = "You are not an administrator";
            return view('pagenotfound', compact('error'));
        }  
    }
// news
    public function all_news(){
         return DB::table('news')->orderBy('updated_at','desc')->get();
     }
    
     public function store_news(Request $req){
        return News::create([
            'title' => $req->input('title'),
            'text' => $req->input('text')
        ]);
     }
    public function update_news(Request $req, $id){
          News::findOrFail($id)->update([ 'title'=>$req->input('title'), 'text'=>$req->input('text') ]);
        return;
     }

    public function delete_news( $id){
        News::destroy($id);
         return $id;
     }
// staff




    public function all_staff(){
         $hod = DB::table('staff')->where('type', '=', 'hod')->orderBy('name','asc')->get();
         $hoo = DB::table('staff')->where('type', '=', 'hoo')->orderBy('name','asc')->get();
         $teacher = DB::table('staff')->where('type', '=', 'teacher')->orderBy('name','asc')->get();
         $delegate = DB::table('staff')->where('type', '=', 'delegate')->orderBy('name','asc')->get();
         return ['hod'=>$hod,'hoo'=>$hoo, 'teacher'=>$teacher, 'delegate'=>$delegate];
     }
    
     public function store_staff(Request $req){
        try{   
           return Staff::create([
                'name' => $req->input('name'),
                'type' => $req->input('type'),
                'email' => $req->input('email'),
                'phone' => $req->input('phone'),
                'description' => $req->input('description'),
            ]);
        } 
        catch(\Exception $e){
            return $e->getMessage();
        }
     }
    public function update_staff(Request $req, $id){
        try{
            Staff::findOrFail($id)->update([
                'name'=>$req->input('name'), 
                'type'=>$req->input('type'),
                'email'=>$req->input('email'),
                'phone'=>$req->input('phone'),
                'description'=>$req->input('description'),
            ]);
            return "updated";
        }
        catch(\Exception $e){
            return $e->getMessage();
        }
     }

    public function delete_staff( $id){
        Staff::destroy($id);
         return $id;
     }
    
}

