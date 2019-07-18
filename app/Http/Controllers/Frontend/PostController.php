<?php

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Category;
use App\Post;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $data = [];

    public function postAction($slug)
    {
        if (!$slug || $slug == '') {
            abort(404);
        }

        $currentPost = Post::where(['slug' => $slug])->first();
        if (!$currentPost) {
            abort(404);
        }

        $currentPost->views++;
        $currentPost->save();

        $this->data['post'] = $currentPost;

        $categories = Category::all();
        $this->data['categories'] = $categories;

        return view('frontend.post', $this->data);
    }

    public function likeAction(Request $request)
    {
        // самое правильное решение позволить ставить лайки только зарегистрированным пользователям (как это делается в социальных сетях).
    }


    
}
