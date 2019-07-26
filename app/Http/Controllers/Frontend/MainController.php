<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    private $data = [];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @return Factory|View
     */
    public function indexAction()
    {
        $posts = Post::with(['comments', 'author', 'tags', 'like'])->paginate(3);
        $categories = Category::all();
        $this->data['posts'] = $posts;
        $this->data['categories'] = $categories;
        $this->data['entity'] = [
            'name' => 'Main Page',
            'page' => 'mainPage',
            'title' => 'Main Page',
            'id' => NULL
        ];

        return view('frontend.posts', $this->data);
    }

    /**
     * @param Request $request
     * @return Factory|JsonResponse|View
     * @throws \Throwable
     */
    public function postAction(Request $request)
    {
        if(!$request->ajax()) {
            return $this->indexAction();
        }

        $requestData = $request->all();
        $action = $requestData['action'];
        $visible = intval($requestData['visible']);
        $id = $requestData['id'];
        $sortDate = $requestData['sortDate']== 'true';
        $sortViews = $requestData['sortViews'] == 'true';
        $sortLikes = $requestData['sortLikes'] == 'true';

        $query = Post::query()->with(['comments', 'author', 'tags', 'like' ]);

        switch ($requestData['entity']) {

            case 'mainPage':
                break;

            case 'categoryPage':
                $query->where('category_id', $id);
                break;

            case 'authorPage':
                $query->where('author_id', $id);
                break;

            case 'tagPage':
                $query->whereHas('tags', function($q) use ($id) {
                    $q->where('tag_id', $id);
                });

                break;
            default:
                return response()->json([
                    'code' => 0
                ]);
                break;
        }

        if ($sortViews) {
            $query->orderBy('views', 'desc');
        }

        if ($sortLikes) {
            $query->orderBy('likes', 'desc');
        }

        if ($sortDate) {
            $query->orderBy('updated_at', 'desc');
        }

        if ($action == 'showMore') {
            $posts = $query->paginate(3);
        } else {
            $posts = $query->paginate($visible);
        }

        return response()->json([
            'code' => 1,
            'currentPage' => $posts->currentPage() + 1,
            'html' => view('frontend.layouts.postsList', ['posts' => $posts])->render()
        ]);
    }
}
