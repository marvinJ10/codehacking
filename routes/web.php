
<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//a nameroute for the post outside the admin middlewaee
Route::get('/post/{id}', ['as'=>'home.post','uses'=>'AdminPostsController@post']);

//Ensure you include the line below for the laravel 5.3 upgrade to work
Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

//Route group for the admin middleware
Route::group(['middleware'=>'admin'], function() {

    //Test the admin homepage
    Route::get('/admin', function () {
        return view('admin.index');
    });
    //initial route for admins with resource for crud operations
    Route::resource('/admin/users', 'AdminUsersController', ['names' => [
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit'
    ]]);
    //posts' route
    Route::resource('/admin/posts', 'AdminPostsController', ['names' => [
        'index' => 'admin.posts.index',
        'create' => 'admin.posts.create',
        'store' => 'admin.posts.store',
        'edit' => 'admin.posts.edit',


    ]]);;
    //categories' route
    Route::resource('/admin/categories', 'AdminCategoriesController', ['names' => [
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'edit' => 'admin.categories.edit'


    ]]);
    //media's route
    Route::resource('/admin/media', 'AdminMediasController', ['names' => [
        'index' => 'admin.media.index',
        'create' => 'admin.media.create',
        'store' => 'admin.media.store',
        'edit' => 'admin.media.edit'
    ]]);

    //comments route
    Route::resource('/admin/comments', 'PostsCommentsController', ['names' => [
        'index' => 'admin.comments.index',
        'create' => 'admin.comments.create',
        'store' => 'admin.comments.store',
        'edit' => 'admin.comments.edit',
        'show' => 'admin.comments.show',

    ]]);
    //replies's route
    Route::resource('/admin/comments/replies', 'PostsRepliesController', ['names' => [
        'index' => 'admin.comments.replies.index',
        'create' => 'admin.comments.replies.create',
        'store' => 'admin.comments.replies.store',
        'edit' => 'admin.comments.replies.edit',
        'show' => 'admin.comments.replies.show',
    ]]);


});