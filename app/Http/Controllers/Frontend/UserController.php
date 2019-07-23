<?php

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Category;
use App\Like;
use App\Post;
use App\User;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class UserController
 * @package App\Http\Controllers\Frontend
 */
class UserController extends Controller
{
    private $data = [];

    /**
     * @param $id
     * @return Factory|View
     */
    public function postsAction($id)
    {
        if (!$id || $id == '') {
            abort(404);
        }

        $user = User::where(['id' => $id])->first();
        if (!$user) {
            abort(404);
        }

        $posts = Post::where(['author_id' => $user->id])->paginate(3);
        $categories = Category::all();
        
        $this->data['categories'] = $categories;
        $this->data['entity'] = [
            'name' => 'Author',
            'page' => 'authorPage',
            'title' => $user->name,
            'id' => $user->id
        ];

        foreach($posts as $post) {
            $likes = Like::where(['post_id' => $post->id])->get();
            $post->likes = count($likes);
        }
        $this->data['posts'] = $posts;
        return view('frontend.posts', $this->data);
    }
}
