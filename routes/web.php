<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('public.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//public route
Route::get('/blog', 'BlogPostController@BlogPost')->name('blog');
Route::get('/blog/{id}', 'BlogPostController@SingleBlog');
Route::get('/categories', 'BlogPostController@getCategories');
Route::get('/categorypost/{id}', 'BlogPostController@getPostById');
Route::get('/search', 'BlogPostController@RealSearch');
Route::post('/userMessage', 'BlogPostController@UserMessage');



Route::group(['middleware'=>['auth']],function(){
// axios category route
Route::post('/add-category', 'CategoryController@store');
Route::get('/category', 'CategoryController@get_category');
Route::get('/category/{id}', 'CategoryController@deleteCategory');
Route::get('/editcategory/{id}', 'CategoryController@editCategory');
Route::post('/editcategory/{id}', 'CategoryController@updateCategory');

// axios category route
Route::post('/add-post', 'PostController@store');
Route::get('/post', 'PostController@get_post');
Route::get('/post/{id}', 'PostController@deletePost');
Route::get('/editpost/{id}', 'PostController@editPost');
Route::post('/editpost/{id}', 'PostController@updatePost');

// vue routes

});
// Route::get('/{anypath}','HomeController@index')->where('path','.*');

