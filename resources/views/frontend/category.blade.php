@extends('frontend.layouts.main')

@section('content')
    <!-- Blog Entries Column -->
    <div class="col-md-8">

        <h1 class="my-4">Posts List
            <small>Secondary Text</small>
        </h1>

        @foreach ($posts as $post)
                <!-- Blog Post -->

            <div class="card mb-4">
                <img class="card-img-top" src="{{ url('/storage/images/'.$post->thumbnail) }}" alt="{{ $post->title }}">
                <div class="card-body">
                    <h2 class="card-title">{{ $post->title }}</h2>
                    <p class="card-text">{{ $post->shortDescription }}</p>
                    <a href="{{ url('post', ['slug' => $post->slug]) }}" class="btn btn-primary">Read More &rarr;</a>
                </div>
                <div class="card-footer text-muted">
                    Posted on {{ $post->created_at }} by
                    <a href="#">{{ $post->author->name }}</a> |
                    Views: {{ $post->views }} | Likes: {{ $post->likes }} | Comments: {{ $post->comments->count() }}
                </div>
                <div class="card-footer text-muted">
                    Tags:
                    @foreach ($post->tags as $tag)
                        <a href="">{{ $tag->title }}</a> |
                    @endforeach
                </div>
            </div>
            <!-- END Blog Post -->
        @endforeach

        {{ $posts->render() }}

    </div>
@endsection