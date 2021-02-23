<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;
//reikia butinai uzsiusint modeli Post.ph
use App\Post;
use Illuminate\Support\Facades\DB;


class BlogController extends Controller
{
    public function __construct()
    {//
        $this->middleware('auth', ['except' => ['index', 'showFull']]);//pasako kad visi metodai kurie yra cia pasiekiami tik prisijungusiam vartotojui isskyrus:...
    }

    public function index()
    {
        //$posts = Post::paginate(5); //buvo all() , o cia puslapiavimas
        $posts = DB::table('posts')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.id', 'posts.title', 'posts.body', 'posts.category_id', 'posts.user_id', 'posts.img', 'posts.created_at', 'categories.category', 'users.name')
            ->paginate(5);
        return view('blog_theme.pages.home', compact('posts'));//reikia nurodyti kelia, jis zino kad yra view aplanke, galima naudoti ir / vietoj .
    }

    public function addPost()
    {
        $options = Category::all();
        return view('blog_theme.pages.add-post', compact('options'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|unique:posts|max:255', // cia is formos name
            'body' => 'required',
            'category' => 'required',
            'img' => 'mimes:jpeg, jpg, png, gif|required|max:10000'
        ]);

        $path = $request->file('img')->store('public/images');
        $filename=str_replace('public/',"", $path);

        Post::create([
            'title' => request('title'),
            'category_id' => request('category'),//key yra is foemos name, o pries => is columo db
            'body' => request('body'),
            'img'=>$filename,
            'user_id' => Auth::id()
        ]);
        return redirect('/')->with(['message' => "Post saved!", 'alert' => 'alert-success']);
    }

    public function showFull(Post $post)
    {
        $additional = DB::table('posts')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->select('categories.category', 'users.name')
            ->where('posts.id', $post->id)
            ->get();
    //dd($post->comments);
        return view('blog_theme.pages.post', compact('post', 'additional'));
    }

    public function edit(Post $post, Request $request)
    {
        if(Gate::allows('update', $post)){;
            /*$post = DB::table('posts')
                ->join('categories', 'posts.category_id', '=', 'categories.id')
                ->select('posts.id', 'posts.title', 'posts.category_id', 'posts.body', 'posts.created_at', 'categories.category')
                ->where('posts.id', $post->id)
                ->get();*/
            $options = Category::all();

               // dd($post);

            return view('blog_theme.pages.edit', compact('post', 'options'));
        }
        return redirect()->back()->with(['message' => "You can not edit another user's posts!", 'alert' => 'alert-danger']);
    }

    public function storeUpdate(Request $request, Post $post)
    {
        if($request->file()){
            File::delete(storage_path('app/public/', $post->img));
            $path=$request->file('img')->store('public/images');
            $filename= str_replace('public/', "", $path);
            Post::where('id', $post->id)->update(['img'=>$filename]);
        }
        Post::where('id', $post->id)->update($request->only(['title', 'category_id', 'body']));
       // dd($request->all());
        return redirect('/post/' . $post->id)->with(['message' => "Post successfully updated!", 'alert' => 'alert-success']);

    }

    public function delete(Post $post)
    {
        if(Gate::allows('delete', $post)){
            $post->delete();

            return redirect('/')->with(['message' => "Post has been deleted!", 'alert' => 'alert-danger']);
        }
        return redirect()->back()->with(['message' => "You can not delete another user's posts!", 'alert' => 'alert-danger']);
    }

    public function showPostsByUser(User $user){
        $filteredPosts = DB::table('posts')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.id','posts.title', 'posts.body', 'posts.category_id', 'posts.user_id', 'posts.created_at',
            'categories.category', 'users.name')
            ->where('users.id', $user->id)
            ->paginate(8);
       // dd($filteredPosts);
return view('blog_theme.pages.byuser', compact('filteredPosts'));
    }
}

