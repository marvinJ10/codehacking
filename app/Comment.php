<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    //mass assignment
    protected  $fillable = [
        'post_id',
        'is_active',
        'author',
        'email',
        'body',
    ];

    //relationship--the comment has many replies
    public  function replies(){
        return $this->hasMany('App\CommentReply');
    }

    //relationship--the comment belongsTo a post
    public function post (){

        return $this->belongsTo('App\Post');
    }
}



