<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //mass assignment
    protected $fillable = ['role_id','is_active','name', 'email', 'password','photo_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //Relationship to the Role--The user belongs to the role
    public function role(){
        return $this->belongsTo('App\Role');
    }

    //Relationship to the Photo--The user belongs to the photo
    public function photo(){
        return $this->belongsTo('App\Photo');
    }

    //Check if user is an admin
    public function isAdmin (){

        // return $this->role->name;
        if($this->role->role == "administrator"){

            return true;
        }

        return false;
    }


}
