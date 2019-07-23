<?php

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Category;
use App\Like;
use App\Post;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    private $data = [];

    /**
     * @param $slug
     * @return Factory|View
     */
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

        $this->data['categories'] = $categories;
        $this->data['entity'] = [
            'name' => 'Category',
            'page' => 'categoryPage',
            'title' => $currentCategory->title,
            'id' => $currentCategory->id
        ];

        foreach($posts as $post) {
            $likes = Like::where(['post_id' => $post->id])->get();
            $post->likes = count($likes);
        }
        $this->data['posts'] = $posts;

        return view('frontend.posts', $this->data);
    }
}
