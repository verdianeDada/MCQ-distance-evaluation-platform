<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Post;
use App\PostComment;

class ForumController extends Controller
{
    public function index(){
        return view('forum');
    }
    
    public function all_post(){
        $posts = Post::with(['user'])->orderBy('updated_at', 'desc')->get();
        $comments = PostComment::with(['user'])->get();
        return ['posts'=>$posts, 'comments' => $comments];
    }
   
    public function store_post(Request $req){
       try{
            return Post::create([
                'text' => $req->input('text'),
                'user_id' => Auth::user()->id
            ]);
        }
       
        catch(\Exception $e){
            return $e->getMessage();
        }
    }
  
    public function delete_post( $id){
       Post::destroy($id);
        return $id;
    }
}
