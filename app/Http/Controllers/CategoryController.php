<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function get_category(){
     $category = Category::all();
     return response()->json([
         'data'=> $category,
     ]);
    }

   public function store(Request $request)
   {
       $this->validate($request,[
           'cat_name'=>'required|min:3',
       ]);
       $category = new Category();
       $category->cat_name =$request->cat_name;
       $category->save();

       return response()->json([
           'message'=>'Category inserted',
           'data'=>$request->all()
       ]);
   }

   public function editCategory($id){
       $category= Category::find($id);
       return response()->json([
           'category'=>$category,
           'success'=>true,
       ]);
   }

  public function deleteCategory($id){
  $category = Category::find($id);
  $category->delete();
  return response()->json([
      'data'=>$category,
      'message'=>'deleted'
  ]);
}

public function updateCategory(Request $request,$id){
 $category = Category::find($id);

 $category->cat_name =$request->cat_name;
 $category->save();

 return response()->json([
     'message'=>'Category inserted',
     'data'=>$request->all()
 ]);
}

}
