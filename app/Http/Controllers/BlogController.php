<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//reikia butinai uzsiusint modeli Post.ph
use App\Post;


class BlogController extends Controller
{
    public function index (){
        $posts = Post::paginate(5); //buvo all() , o cia puslapiavimas
        return view('blog_theme.pages.home', compact('posts'));//reikia nurodyti kelia, jis zino kad yra view aplanke, galima naudoti ir / vietoj .
    }

    public function addPost(){
        $options = [
            'Home interior',
            'Sports',
            'Movies',
            'Food'
        ];
        return view('blog_theme.pages.add-post', compact('options'));
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
            'category' => 'required'
        ]);
        Post::create([
            'title'=> request('title'),
            'category' =>request('category'),
        'body'=> request('body')
        ]);

        return redirect('/');
    }
}
