<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable =['title', 'body', 'category_id', 'img', 'user_id']; //jei nebus $fillable neleis irasyt i DB

    public function comments(){
       return $this->hasMany(Comment::class);
    }

public function user(){
    return $this->belongsTo(User::class);
}
public function category(){
        return $this->belongsTo(Category::class);
}
}
