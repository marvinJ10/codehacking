<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class PostsCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all the comments
        $comments = Comment::orderBy('id','dec')->get();
        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //for populating other fields within the comments table

        //get the logged in user
        $user = Auth::user();

        //getting other field values of the comment

        $data = [
            'post_id'=>$request->post_id,
            'author'=>$user->name,
            'email'=>$user->email,
            'photo'=>$user->photo->file,
            'body'=>$request->body,
        ];

        //create a comment
        Comment::create($data);
        //flash message
        $request -> session()->flash('comment_message','Your comment has been submitted for moderation');
        //redirection
        return redirect()->back();


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get the post id
        $post = Post::findOrFail($id);
        //show all the comments for the respective id
        $comments = $post->comments;

        return view('admin.comments.show', compact('comments'));
    }

    /**
     * Show the form for editing the  specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //update the request
        Comment::findOrFail($id)->update($request->all());

        // return redirect('/admin/comments');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete the comment
        Comment::findOrFail($id)->delete();
        // return redirect('/admin/comments');
        return redirect()->back();
    }
}
