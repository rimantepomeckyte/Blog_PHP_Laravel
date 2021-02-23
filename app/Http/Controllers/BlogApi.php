<?php

namespace App\Http\Controllers;

use App\Http\Resources\Blog;
use App\Post;
use Illuminate\Http\Request;

class BlogApi extends Controller
{
    public function __construct(){
        $this->middleware('auth:api')->except(['index', 'show']);
    }

    public function index(){
        return Blog::collection(Post::with('comments')->get());
    }

    public function show(Post $id){
        return new Blog($id);
    }
}
