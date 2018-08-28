<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

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
        //
        //VALIDATION before saving to the database
//               $this->validate($request, [
//                   'name' =>  'bail|unique:posts|max:255|required',
//                   'email' => 'required',
//                   'role'=>'required',
//                   //'path' => 'required',
//
//        ]);
              // return $request->all();

        //SAVING USER INPUT TO DATABASE

//        if(trim($request->password) == '' ){
//
//            $input = $request->except('password');
//        }else{

            $input = $request->all();

//        }

        //check if there is a file or foto attached
        if($file = $request->file('photo_id')){

            $name = time().$file->getClientOriginalName();
            //move to the public\images directory
            $file->move(public_path().'\images', $name);  // absolute destination path
            //save to the table photos
            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;

        }

        //password encryption
        $input['password'] = bcrypt($request->password);
        //after the above then persist the user to the db,
        User::create($input);

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
        //
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
    }
}
