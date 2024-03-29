<?php

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Category;
use App\Like;
use App\Post;
use App\Tag;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TagController extends Controller
{
    private $data = [];

    /**
     * @param $slug
     * @return Factory|View
     */
    public function postsAction($slug)
    {
        $tag = Tag::where('slug', $slug)->first();
        if (!$tag) {
            abort(404);
        }

        $posts = Post::with(['comments', 'author', 'tags', 'like' ])->whereHas('tags', function($q) use ($tag) {
            $q->whereIn('tag_id', $tag);
        })->paginate(3);
        $this->data['posts'] = $posts;

        $categories = Category::all();
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
