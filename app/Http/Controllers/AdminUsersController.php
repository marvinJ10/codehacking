<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Query all the available users
        $users = User::orderBy('id','dec')->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //allow fetching from the DB
        $roles = Role::lists('role','id')->all();

        return view('admin.users.create', compact('roles'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
           //SAVING USER INPUT TO DATABASE
        //check if password is empty
        if(trim($request->password) == '' ){

            $input = $request->except('password');
        }else{

            $input = $request->all();
            //password encryption
            $input['password'] = bcrypt($request->password);
        }

        //check if there is a file or foto attached
        if($file = $request->file('photo_id')){

            $name = time().$file->getClientOriginalName();
            //move to the public\images directory`
            $file->move(public_path().'\images', $name);  // absolute destination path
            //save to the table photos
            $photo = Photo::create(['file'=>$name]);
            //get the id of the photo from the photos table and place it on the users table under column photo_id
            $input['photo_id'] = $photo->id;

        }


        //after the above then persist the user to the db,
        User::create($input);
        Session::flash('create_user','The user has been successfully created');

        return redirect('/admin/users');
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
        //Find the user to edit
        $user = User::findOrFail($id);

        //pass in the roles
        $roles = Role::lists('role','id')->all();

        return view('admin.users.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UsersEditRequest $request, $id)
    {
        //check if password is empty
        if(trim($request->password) == '' ){

            $input = $request->except('password');
        }else{

            $input = $request->all();
            //password encryption
            $input['password'] = bcrypt($request->password);
        }

        //find user to update
        $user = User::findOrFail($id);
        //fetch the input for the update method
        $input = $request->all();

        //check if there is a file or foto attached
        if($file = $request->file('photo_id')){

            $name = time().$file->getClientOriginalName();
            //move to the public\images directory`
            $file->move(public_path().'\images', $name);  // absolute destination path
            //save to the table photos
            $photo = Photo::create(['file'=>$name]);
            //get the id of the photo from the photos table and place it on the users table under column photo_id
            $input['photo_id'] = $photo->id;

        }

        //now update the user input and redirect
        $user->update($input);
        Session::flash('updated_user','The user details have been successfully updated');
        return redirect('/admin/users');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);
        //image delation alongside user ID
        unlink(public_path().$user->photo->file);  // absolute destination path

        $user->destroy($id);


        Session::flash('deleted_user','The user has been deleted');

        return redirect('/admin/users');

    }
}
