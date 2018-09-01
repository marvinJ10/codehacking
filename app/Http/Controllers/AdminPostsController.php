<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostsCreateRequest;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //display the posts
        $posts = Post::orderBy('id','dec')->get();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::lists('name','id')->all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        //assign the request
        $input = $request->all();
        //get the logged in user for population to db relationship
        $user = Auth::user();
        //check if there is a file or foto attached
        if ($file = $request->file('photo_id')) {

            $name = time() . $file->getClientOriginalName();
            //move to the public\images directory`
            $file->move(public_path() . '\images', $name);  // absolute destination path
            //save to the table photos
            $photo = Photo::create(['file' => $name]);
            //get the id of the photo from the photos table and place it on the users table under column photo_id
            $input['photo_id'] = $photo->id;
        }

        //persist the post to the db and redirect
        $user->posts()->create($input);
        //flash message
        Session::flash('create_post','The post has been successfully created');
        //return redirect
        return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //find the post
        $post = Post::findOrFail($id);

        //populate the categories
        $categories = Category::lists('name','id')->all();

        return view('admin.posts.edit', compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //get all the fields
        $input = $request->all();
//        //get the logged in user for population to db relationship
//        $user = Auth::user();
        //check if there is a file or photo attached
        if ($file = $request->file('photo_id')) {

            $name = time() . $file->getClientOriginalName();
            //move to the public\images directory`
            $file->move(public_path() . '\images', $name);  // absolute destination path
            //save to the table photos
            $photo = Photo::create(['file' => $name]);
            //get the id of the photo from the photos table and place it on the users table under column photo_id
            $input['photo_id'] = $photo->id;
        }

        //get the user and the queried postID and update using all the inputs
        Auth::user()->posts()->whereId($id)->first()->update($input);

        return redirect('/admin/posts/');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find the id to be destroyed
        $post = Post::findOrFail($id);
        //image deletion alongside user ID
        unlink(public_path().$post->photo->file);  // absolute destination path

        $post->destroy($id);


        Session::flash('deleted_post','The post has been deleted');

        return redirect('/admin/posts');
    }
}
