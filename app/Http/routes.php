<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

//a nameroute for the post outside the admin middlewaee
Route::get('/post/{id}', ['as'=>'home.post','uses'=>'AdminPostsController@post']);


//Route group for the admin middleware
Route::group(['middleware'=>'admin'], function(){

    //Test the admin homepage
    Route::get('/admin' , function (){
        return view('admin.index');
    });
    //initial route for admins with resource for crud operations
    Route::resource('/admin/users', 'AdminUsersController');
    //posts' route
    Route::resource('/admin/posts', 'AdminPostsController');
    //categories' route
    Route::resource('/admin/categories', 'AdminCategoriesController');
    //media's route
    Route::resource('/admin/media', 'AdminMediasController');
    //comments route
    Route::resource('/admin/comments', 'PostsCommentsController');
    //replies's route
    Route::resource('/admin/comments/replies', 'PostsRepliesController');
});

//route for only logged in users
Route::group(['middleware'=>'auth'], function(){
    //CommentReplies's route
    Route::post('comment/reply', 'PostsRepliesController@createReply');
});
