<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'BlogController@index');
Route::get('/add-post', 'BlogController@addPost');
Route::post('/store', 'BlogController@store');
Route::get('/post/{post}', 'BlogController@showFull');
Route::get('/edit/{post}', 'BlogController@edit');
Route::patch('/storeupdate/{post}', 'BlogController@storeUpdate');
Route::get('/delete/{post}', 'BlogController@delete');
Route::get('/add-category', 'CategoryController@addCategory');
Route::post('/cat', 'CategoryController@cat');
Route::get('/categories-list', 'CategoryController@showCategories');
Route::get('/delete/category/{category}', 'CategoryController@delete');
Route::get('/category/{category}', 'CategoryController@showPostsByCategory');

