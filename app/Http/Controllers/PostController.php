<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Auth;
use Image;
use cache;

class PostController extends Controller
{
    public function get_post()
    {
        // $posts = Post::with('category', 'user')->orderBy('id', 'desc')->get();
        // return response()->json([
        //     'data' => $posts,
        // ]);
        
        $posts = cache('posts', function () {
            return Post::with('user', 'category')->latest()->get();
        });
          return response()->json([
            'data' => $posts,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|min:2|max:50',
            'description'=>'required|min:2|max:1000'
        ]);
        $strpos = strpos($request->photo,';');
        $sub = substr($request->photo,0,$strpos);
        $ex = explode('/',$sub)[1];
        $name = time().".".$ex;
        $img = Image::make($request->photo)->resize(200, 200);
        $upload_path = public_path()."/uploadimage/";
        $img->save($upload_path.$name);
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->cat_id = $request->cat_id;
        $post->user_id = Auth::user()->id;
        $post->photo = $name;
        $post->save();
    }

    public function updatePost(Request $request,$id)
    {
        $this->validate($request,[
            'title'=>'required|min:2|max:50',
            'description'=>'required|min:2|max:1000'
        ]);
        $strpos = strpos($request->photo,';');
        $sub = substr($request->photo,0,$strpos);
        $ex = explode('/',$sub)[1];
        $name = time().".".$ex;
        $img = Image::make($request->photo)->resize(200, 200);
        $upload_path = public_path()."/uploadimage/";
        $img->save($upload_path.$name);
        $post = Post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->cat_id = $request->cat_id;
        $post->user_id = Auth::user()->id;
        $post->photo = $name;
        $post->save();
    }


    public function editPost($id)
    {
        $post = Post::find($id);
        return response()->json([
            'post' => $post,
        ]);
    }

    public function deletePost($id)
    {
        $post = Post::find($id);
        $post->delete();
        return response()->json([
            'data' => $post,
            'success' => true,
        ]);
    }
}
