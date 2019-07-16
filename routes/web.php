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

Route::get('/', 'Frontend\MainController@indexAction')->name('frontend-main');

Auth::routes();

Route::get('/category/{slug}', 'Frontend\CategoryController@indexAction')->name('frontend-category');

Route::get('/post/{url}', 'Frontend\PostController@indexAction')->name('frontend-post');
