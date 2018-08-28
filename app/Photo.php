<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //mass assignment
    protected $fillable = ['file'];
}
