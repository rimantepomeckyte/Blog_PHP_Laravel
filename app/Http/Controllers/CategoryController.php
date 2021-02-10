<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function addCategory()
    {
        return view('blog_theme.pages.add-category');
    }

    public function cat(Request $request){
        $validatedData = $request->validate([
            'category' => 'required'
        ]);

        Category::create([
            'category' =>request('category')
        ]);

        return redirect('/categories-list/');
    }

    public function showCategories(){
        $category =Category::all();
        return view('blog_theme.pages.categories-list', compact('category'));//reikia nurodyti kelia, jis zino kad yra view aplanke, galima naudoti ir / vietoj .
    }

    public function delete(Category $category){
        $category->delete();
        return redirect('/categories-list/');
    }

    public function showPostsByCategory(Category $category){
        $filteredPosts = DB::table('posts')
            ->join('categories', 'categories.id', '=','posts.category_id')
            ->select('*')
            ->where('categories.id', $category->id)
            ->paginate(8);
       // dd($filteredPosts);
        return view('blog_theme.pages.bycategory', compact('filteredPosts'));
    }
}
