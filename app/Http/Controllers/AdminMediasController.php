<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class AdminMediasController extends Controller
{
    //display all the images
    public function index(){
        $photos = Photo::orderBy('id','dec')->get();

        return view('admin.media.index', compact('photos'));
    }
    //set up the create method for uploading media
    public  function  create(){
        return view('admin.media.create');
    }
    public function store(Request $request)
    {
        //get file id
        $file = $request->file('file');

            $name = time() . $file->getClientOriginalName();
            //move to the public\images directory`
            $file->move(public_path() . '\images', $name);  // absolute destination path
            //save to the table photos
            Photo::create(['file' => $name]);

        }

    public function destroy($id)
    {
        //find the id to be destroyed
        $photo = Photo::findOrFail($id);
        //image deletion alongside user ID
        unlink(public_path().$photo->file);  // absolute destination path

        $photo->destroy($id);


        Session::flash('deleted_media','The media has been deleted');

        return redirect('/admin/media');
    }
}
