@extends('frontend.layouts.main')

@section('content')
    <!-- Blog Entries Column -->
    <div class="col-md-8">

        <h1 class="my-4">Posts List
            <small>Category {{ $currentCategory->title }}</small>
        </h1>

        @foreach ($posts as $post)

            <div class="card mb-4">
                <img class="card-img-top" src="{{ url('/storage/images/'.$post->thumbnail) }}" alt="{{ $post->title }}">
                <div class="card-body">
                    <h2 class="card-title">{{ $post->title }}</h2>
                    <p class="card-text">{{ $post->shortDescription }}</p>
                    <a href="{{ url('post', ['slug' => $post->slug]) }}" class="btn btn-primary">Read More &rarr;</a>
                </div>
                <div class="card-footer text-muted">
                    Posted on {{ $post->created_at }} by
                    <a href="{{ url('author', ['id' => $post->author->id]) }}">{{ $post->author->name }}</a>    
                </div>
                <div class="card-footer text-muted">
                    <div class="info">
                        <strong>Tags: </strong>
                        @foreach($post->tags as $tag)
                            <a href="{{ url('tag', ['slug' => $tag->slug]) }}">{{ $tag->title }}</a> |
                        @endforeach
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <div class="info">
                        <strong>Views:</strong> {{ $post->views }} |
                        <strong>Likes:</strong> <a href="javascript:void(0);" title="Like this post"><i class="fa fa-heart-o" aria-hidden="true"></i></a> {{ $post->likes }} |
                        <strong>Comments:</strong> {{ $post->comments->count() }}
                    </div>
                </div>
            </div>
            <!-- END Blog Post -->
        @endforeach

        Show more

    </div>
@endsection

@section('sorting')

<!-- Sorting Widget -->
<div class="card my-4">
    <h5 class="card-header">Sorting by : </h5>
    <div class="card-body">
        
        <div class="form-check">
            <label class="form-check-label">
                <input name="date" type="checkbox" class="form-check-input" value="date" autovomplete="off">Date
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input name="views" type="checkbox" class="form-check-input" value="views" autovomplete="off">Views
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input name="likes" type="checkbox" class="form-check-input" value="likes" autovomplete="off">Likes
            </label>
        </div>

    </div>
</div>

@endsection