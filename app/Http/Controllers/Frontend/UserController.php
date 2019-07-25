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
        $user = User::where('id', $id)->first();
        if (!$user) {
            abort(404);
        }

        $posts = Post::with(['comments', 'author', 'tags', 'like' ])->where('author_id', $user->id)->paginate(3);
        $this->data['posts'] = $posts;

        $categories = Category::all();
        $this->data['categories'] = $categories;
        $this->data['entity'] = [
            'name' => 'Author',
            'page' => 'authorPage',
            'title' => $user->name,
            'id' => $user->id
        ];

        return view('frontend.posts', $this->data);
    }
}
