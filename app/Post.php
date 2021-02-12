<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable =['title', 'body', 'category_id', 'img', 'user_id']; //jei nebus $fillable neleis irasyt i DB
}
