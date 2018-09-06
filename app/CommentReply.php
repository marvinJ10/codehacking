<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{

    //mass assignment
    protected  $fillable = [
        'comment_id',
        'is_active',
        'author',
        'email',
        'body',
        'photo'

    ];

    //relationship--the comment belogs to
    public  function commentreplies(){
        return $this->belongsTo('App\Comment');
    }
}
