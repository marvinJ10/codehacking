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

//initial route for admins with resource for crud operations
Route::resource('/admin/users', 'AdminUsersController');

//Test the admin homepage
Route::get('/admin' , function (){
    return view('admin.index');
});