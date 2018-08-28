<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

    //for the accessor to make image fetching dynamic
    protected  $uploads='/images/';
    //mass assignment
    protected $fillable = ['file'];




    //accessor for the file to make it dynamic
    public  function getFileAttribute($photo){
            return $this->uploads.$photo;

    }

}
