<?php

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Category;
use App\Post;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $data = [];


    public function indexAction()
    {

    }

    public function categoryAction($slug)
    {
        if (!$slug || $slug == '') {
            abort(404);
        }

        $currentCategory = Category::where(['slug' => $slug])->first();
        if (!$currentCategory) {
            abort(404);
        }

        $posts = Post::where(['category_id' => $currentCategory->id])->paginate(3);
        $categories = Category::all();

        $this->data['posts'] = $posts;
        $this->data['categories'] = $categories;
        $this->data['entity'] = [
            'name' => 'Category',
            'page' => 'categoryPage',
            'title' => $currentCategory->title,
            'id' => $currentCategory->id
        ];
        return view('frontend.posts', $this->data);
    }
}
