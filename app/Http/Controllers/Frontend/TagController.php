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

        $categories = Category::all();


        $this->data['categories'] = $categories;
        $this->data['entity'] = [
            'name' => 'Tag',
            'page' => 'tagPage',
            'title' => $tag->title,
            'id' => $tag->id
        ];

        foreach($posts as $post) {
            $likes = Like::where(['post_id' => $post->id])->get();
            $post->likes = count($likes);
        }
        $this->data['posts'] = $posts;

        return view('frontend.posts', $this->data);
    }
}
