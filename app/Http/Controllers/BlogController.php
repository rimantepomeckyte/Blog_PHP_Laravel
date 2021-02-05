<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index (){
        return view('blog_theme.pages.home');//reikia nurodyti kelia, jis zino kad yra view aplanke, galima naudoti ir / vietoj .
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
}
