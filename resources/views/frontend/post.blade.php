@extends('frontend.layouts.main')

<style>
    .info {
        font-size: 14px;
    }
</style>

@section('content')
    <!-- Post Content Column -->
    <div class="col-lg-8">

        <!-- Title -->
        <h1 class="mt-4">{{ $post->title }}</h1>

        <!-- Author -->
        <p class="lead">
            by
            <a href="#">{{ $post->author->name }}</a>
        </p>

        <hr>

        <div>{{ $post->shortDescription }}</div>

        <hr>
        <div class="info">
            <strong>Tags: </strong>
            @foreach($post->tags as $tag)
                <a href="">{{ $tag->title }}</a> |
            @endforeach
            <strong>Views:</strong> {{ $post->views }} |
            <strong>Likes:</strong> {{ $post->likes }} |
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

        <!-- Comments Form -->
        <div class="card my-4">
            <h5 class="card-header">Leave a Comment:</h5>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

        <!-- Comments -->

        @foreach ($post->comments as $comment)
            <!-- Single Comment -->
                <div class="media mb-4">
                    <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                    <div class="media-body">
                        <h5 class="mt-0">{{ $comment->author->name }}</h5>
                        {{ $comment->content }}
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
        @endforeach

        <!-- END Comments -->

    </div>
@endsection