<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //mass assignment
    protected $fillable = ['user_id', 'category_id', 'photo_id', 'title', 'body'];

    //relationship to the user model
    public function user(){
        return $this->belongsTo('App\User');
    }

    //relationship to the photo model
    public function photo(){
        return $this->belongsTo('App\Photo');
    }

    //relationship to the category model
    public function category(){
        return $this->belongsTo('App\Category');
    }

    //relationship to the model Comment
    public  function comments(){
        return $this->hasMany('App\Comment');
    }

    //function for placeholder
    public  function photoPlaceHolder(){
        return "https://via.placeholder.com/600x200";
    }
}
