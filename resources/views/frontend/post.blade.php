@extends('frontend.layouts.main')

@section('content')

    <!-- Post Content Column -->
    <div class="col-lg-8">

        <!-- Title -->
        <h1 class="mt-4">{{ $post->title }}</h1>

        <input type="hidden" id="currentPostId" value="{{ $post->id }}">

        <!-- Author -->
        <p class="lead">
            bys
            <a href="#">{{ $post->author->name }}</a>
        </p>

        <hr>

        <div>{{ $post->shortDescription }}</div>

        <hr>
        <div class="info">
            <strong>Tags: </strong>
            @foreach($post->tags as $tag)
                <a href="{{ url('tag', ['slug' => $tag->slug]) }}">{{ $tag->title }}</a> |
            @endforeach
            <strong>Views:</strong> {{ $post->views }} |
            @auth
                <strong>Likes:</strong>
                <a class="likePostLink" href="javascript:void(0);" title="Like this post"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                <span id="postLikes_{{ $post->id }}">{{ $post->like->count() }}</span> |
            @endauth
                
            @guest
                <strong>Likes:</strong> <i class="fa fa-heart-o" aria-hidden="true"></i>{{ $post->like->count() }} |
            @endguest
            <strong>Comments:</strong> {{ $post->comments->count() }}
        </div>
        <hr>

        <!-- Date/Time -->
        <p>Posted on {{ $post->created_at }}</p>

        <hr>

        <!-- Preview Image -->
        <img class="img-fluid rounded" src="{{ url('/storage/images/'.$post->thumbnail) }}" alt="{{ $post->title }}">

        <hr>

        <!-- Post Content -->
        {{ $post->fullDescription }}
        <hr>

        @auth
        <!-- Comments Form -->
        <div class="card my-4">
            <h5 class="card-header">Leave a Comment:</h5>
            <div class="card-body">
                <form id="commentForm">
                    <div class="form-group">
                        <textarea class="form-control" rows="3" autocomplete="off"></textarea>
                    </div>
                    <button type="submit" class="commentFormSubmitButton btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        @endauth

        <!-- Comments -->

        <div id="commentsWrapper">
            @foreach ($post->comments as $comment)
            <!-- Single Comment -->
            <div class="media mb-4">
                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                <div class="media-body">
                    <h5 class="mt-0">{{ $comment->author->name }}</h5>
                    {{ $comment->content }}
                    @auth
                        <div>
                            <a data-toggle="collapse" href="#comment_{{ $comment->id }}_AnswerForm" role="button"
                               aria-expanded="false" aria-controls="comment_{{ $comment->id }}_AnswerForm">
                                Send Answer
                            </a>
                        </div>

                        <div class="collapse" id="comment_{{ $comment->id }}_AnswerForm">
                            <h5 class="card-header">Send Answer for a Comment:</h5>
                            <div class="card card-body">
                                <form class="answerForm">
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" autocomplete="off"></textarea>
                                        <input type="hidden" class="commentId" value="{{ $comment->id }}">
                                    </div>
                                    <button type="submit" class="answerFormSubmitButton btn btn-primary">Submit
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endauth

                    <div class="answersWrapper" data-comment-id="{{ $comment->id }}">
                    @foreach ($comment->answers as $answer)
                        <div class="media mt-4">
                            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                            <div class="media-body">
                                <h5 class="mt-0">{{ $answer->author->name }}</h5>
                                {{ $answer->content }}
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
            @endforeach
            <!-- END Comments -->
        </div>

    </div>
@endsection