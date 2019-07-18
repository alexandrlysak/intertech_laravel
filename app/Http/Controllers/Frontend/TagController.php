<?php

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Category;
use App\Post;
use App\Tag;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class TagController extends Controller
{
    private $data = [];

    public function postsAction($slug)
    {
        if (!$slug || $slug == '') {
            abort(404);
        }

        $tag = Tag::where(['slug' => $slug])->first();
        if (!$tag) {
            abort(404);
        }

        $posts = Post::whereHas('tags', function($q) use ($tag) {
            $q->whereIn('tag_id', $tag);
        })->paginate(3);

        
        // $posts = Post::whereHas('tags', function($query) use ($tag) {
        //     $query->where($tag);
        // })->paginate(3);
        $categories = Category::all();

        $this->data['posts'] = $posts;
        $this->data['categories'] = $categories;
        $this->data['entity'] = [
            'name' => 'Tag',
            'page' => 'tagPage',
            'title' => $tag->title,
            'id' => $tag->id
        ];
        return view('frontend.posts', $this->data);
    }
}
