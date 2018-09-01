<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //mass assignment
    protected  $fillable = ['name'];
}
