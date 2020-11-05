<?php

namespace App\Http\Controllers;

use App\Category;
use App\Contact;
use App\Post;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
   public function BlogPost(){
    $blog = Post::with('category','user')->orderBy('id','desc')->get();
    return response()->json([
        'data'=>$blog,
        'success'=>true,
     ]);
    }


    public function SingleBlog($id){
        $blog = Post::with('category','user')->where('id',$id)->first();

        return response()->json([
            'data'=>$blog,
            'success'=>true,
         ]);
    }

    public function getCategories(){
        $categories = Category::orderBy('id','desc')->withCount('posts')->get();
        return response()->json([
            'data'=>$categories,
            'success'=>'true'
        ]);
    }
    public function getPostById($id){
        $posts = Post::with('user','category')->where('cat_id',$id)->orderBy('id','desc')->get();
        return response()->json([
            'data'=>$posts
        ],200);
    }


    public function RealSearch(){
        $search = \Request::get('s');
        if($search!=null)
        {
        $posts = Post::with('user','category')
        ->where('title','LIKE',"%$search%")
        ->orWhere('description','LIKE',"%$search%")
        ->get();
        return response()->json([
            'data'=>$posts,
            'success'=>true,
        ]);
    }else{
       return $this->BlogPost();
    }
    }

    public function UserMessage(Request $request)
    {
        $this->validate($request,[
            'email'=>'required',
            'message'=>'required',
        ]);
        $contact = new Contact();
        $contact->email =$request->email;
        $contact->subject =$request->subject;
        $contact->message =$request->message;
        $contact->name =$request->name;
        $contact->save();
 
        return response()->json([
            'message'=>'Message sent',
            'data'=>$request->all()
        ]);
    }
}

