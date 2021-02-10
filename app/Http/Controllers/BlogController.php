<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
//reikia butinai uzsiusint modeli Post.ph
use App\Post;
use Illuminate\Support\Facades\DB;


class BlogController extends Controller
{
    public function index (){
        //$posts = Post::paginate(5); //buvo all() , o cia puslapiavimas
        $posts = DB::table('posts')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->select('posts.id', 'posts.title', 'posts.body', 'posts.created_at', 'categories.category')
            ->paginate(5);
        return view('blog_theme.pages.home', compact('posts' ));//reikia nurodyti kelia, jis zino kad yra view aplanke, galima naudoti ir / vietoj .
    }

    public function addPost(){
        $options =Category::all();
        return view('blog_theme.pages.add-post', compact('options'));
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'title' => 'required|unique:posts|max:255', // cia is formos name
            'body' => 'required',
            'category' => 'required'
        ]);
        Post::create([
            'title'=> request('title'),
            'category_id' =>request('category'),//key yra is foemos name, o pries => is columo db
        'body'=> request('body')
        ]);

        return redirect('/');
    }

    public function showFull (Post $post){
        return view('blog_theme.pages.post', compact('post'));
    }

    public function edit (Post $post){
        $options =Category::all();
        return view('blog_theme.pages.edit', compact('post', 'options'));
    }

    public function storeUpdate(Request $request, Post $post){
    Post::where('id', $post->id)->update($request->only(['title', 'category_id', 'body']));
    return redirect('/post/'.$post->id);
    }

    public function delete(Post $post){
        $post->delete();

        return redirect('/');
    }
}
