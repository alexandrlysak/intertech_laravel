<?php

namespace App\Http\Controllers\Frontend;


use App\Answer;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Category;
use App\Like;
use App\Post;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;


/**
 * Class PostController
 * @package App\Http\Controllers\Frontend
 */
class PostController extends Controller
{
    private $data = [];

    /**
     * @param $slug
     * @return Factory|View
     */
    public function postAction($slug)
    {
        $currentPost = Post::where('slug', $slug)->first();
        if (!$currentPost) {
            abort(404);
        }

        $currentPost->views++;
        $currentPost->save();

        $categories = Category::all();
        $this->data['categories'] = $categories;

        $this->data['post'] = $currentPost;

        return view('frontend.post', $this->data);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function likeAction(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'code' => 0
            ]);
        }

        $validator = Validator::make($request->all(),[
            'postId' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 0,
                'errors'=>$validator->errors()->all()
            ]);
        }

        $postId = $request->get('postId');

        $existsLike = Like::where(['author_id' => $user->id, 'post_id' => $postId])->first();
        if (!$existsLike) {
            $like = new Like();
            $like->author_id = $user->id;
            $like->post_id = $postId;
            $like->save();
        }

        $likes = Like::where('post_id', $postId)->get()->count();

        return response()->json([
            'code' => 1,
            'likes' => $likes
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Throwable
     */
    public function commentAction(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'code' => 0
            ]);
        }

        $validator = Validator::make($request->all(),[
            'postId' => 'required',
            'commentContent' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 0,
                'errors'=>$validator->errors()->all()
            ]);
        }

        $comment = new Comment();
        $comment->author_id = $user->id;
        $comment->content = $request->get('commentContent');
        $comment->post_id = $request->get('postId');
        $comment->save();

        return response()->json([
            'code' => 1,
            'commentId' => $comment->id,
            'html' => view('frontend.layouts.postComment', [
                'comment' => $comment,
                'author' => $user
            ])->render()
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Throwable
     */
    public function answerAction(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'code' => 0
            ]);
        }

        $validator = Validator::make($request->all(),[
            'postId' => 'required',
            'commentId' => 'required',
            'answerContent' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 0,
                'errors'=>$validator->errors()->all()
            ]);
        }

        $answer = new Answer();
        $answer->content = $request->get('answerContent');
        $answer->author_id = $user->id;
        $answer->comment_id = $request->get('commentId');
        $answer->save();

        return response()->json([
            'code' => 1,
            'html' => view('frontend.layouts.postAnswerComment', [
                'answer' => $answer,
                'author' => $user
            ])->render()
        ]);
    }
}
