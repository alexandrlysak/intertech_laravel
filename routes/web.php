<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::post('/ulogin', 'Frontend\UloginController@loginAction');

Route::get('/', 'Frontend\MainController@indexAction')->name('frontend-main');
Route::post('/', 'Frontend\MainController@postAction')->name('post-main');
Route::post('/sort', 'Frontend\MainController@sortAction')->name('post-main-sort');

Auth::routes();


Route::get('/category/{slug}', 'Frontend\CategoryController@categoryAction')->name('frontend-category');
Route::post('/category', 'Frontend\CategoryController@postAction')->name('post-category');

Route::get('/post/{slug}', 'Frontend\PostController@postAction')->name('frontend-post');

Route::get('/author/{id}', 'Frontend\UserController@postsAction')->name('author-posts');
Route::post('/author', 'Frontend\UserController@postAction')->name('post-author');

Route::get('/tag/{slug}', 'Frontend\TagController@postsAction')->name('tag-posts');
Route::post('/tag', 'Frontend\TagController@postAction')->name('post-tag');


