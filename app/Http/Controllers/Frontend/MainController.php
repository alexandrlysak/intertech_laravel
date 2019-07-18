<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Auth;

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
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function indexAction()
    {
        $posts = Post::orderBy('updated_at', 'desc')->take(3)->get();
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

    public function postAction(Request $request)
    {
        if(!$request->ajax()) {
            return $this->indexAction();
        }

        $requestData = $request->all();
        $visible = intval($requestData['visible']);
        $id = $requestData['id'];
        $sortDate = $requestData['sortDate']== 'true';
        $sortViews = $requestData['sortViews'] == 'true';
        $sortLikes = $requestData['sortLikes'] == 'true';

        switch ($requestData['entity']) {

            case 'mainPage':
                $query = Post::take(3);
                break;

            case 'categoryPage':
                $query = Post::where(['category_id' => $id])->take(3);
                break;

            case 'authorPage':
                $query = Post::where(['author_id' => $id])->take(3);
                break;

            case 'tagPage':
                $tag = Tag::find($id);
                if (!$tag) {
                    return response()->json([
                        'code' => 0
                    ]);
                }
                $query = Post::whereHas('tags', function($q) use ($tag) {
                    $q->whereIn('tag_id', $tag);
                })->take(3);
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

        if ($visible > 0) {
            $query->offset($visible);
        }

        $posts = $query->get();

        return response()->json([
            'code' => 1,
            'html' => view('frontend.layouts.postsList', ['posts' => $posts])->render()
        ]);
    }

    public function sortAction(Request $request)
    {
        if(!$request->ajax()) {
            return $this->indexAction();
        }

        $requestData = $request->all();

        
        $visible = intval($requestData['visible']);
        $id = $requestData['id'];
        $sortDate = $requestData['sortDate']== 'true';
        $sortViews = $requestData['sortViews'] == 'true';
        $sortLikes = $requestData['sortLikes'] == 'true';

        switch ($requestData['entity']) {

            case 'mainPage':
                $query = Post::take($visible);
                break;

            case 'categoryPage':
                $query = Post::where(['category_id' => $id])->take($visible);
                break;

            case 'authorPage':
                $query = Post::where(['author_id' => $id])->take($visible);
                break;

            case 'tagPage':
                $tag = Tag::find($id);
                if (!$tag) {
                    return response()->json([
                        'code' => 0
                    ]);
                }
                $query = Post::whereHas('tags', function($q) use ($tag) {
                    $q->whereIn('tag_id', $tag);
                })->take($visible);
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

        $posts = $query->get();

        return response()->json([
            'code' => 1,
            'html' => view('frontend.layouts.postsList', ['posts' => $posts])->render()
        ]);


    }
}
