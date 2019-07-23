@extends('frontend.layouts.main')

@section('scripts')
    @parent
    <script>

        // Show More posts init
        jQuery(document).ready(function() {
            
            jQuery('.showMoreButton a').on('click', function() {
                showMorePosts( '{{ $entity['page'] }}', '{{url('/')}}', '{{ $entity["id"]}}', '{{ url('/post/like')}}');
            });

            jQuery('#sortWrapper input').on('change', function() {
                sortingPosts('{{ $entity['page'] }}', '{{url('/sort')}}', '{{ $entity["id"]}}', '{{ url('/post/like')}}');
            });

            jQuery('#postsListWrapper .likePostLink').on('click', function() {
                likePost(jQuery(this).closest('.info').find('input.postId').val(), '{{ url('/post/like')}}');
            });


        });
    </script>
@endsection

@section('content')
    <!-- Blog Entries Column -->
    <div class="col-md-8">

        <h1 class="my-4">Posts List
            <small> by {{ $entity['name'] }} : [{{ $entity['title'] }}]</small>
        </h1>

        <div id="postsListWrapper">
        @foreach ($posts as $post)

        
            <div class="card mb-4 postItem">
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
                        <input type="hidden" class="postId" value="{{ $post->id }}">
                        <strong>Views:</strong> {{ $post->views }} |
                        @auth
                            <strong>Likes:</strong>
                            <a class="likePostLink" href="javascript:void(0);" title="Like this post"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                            <span id="postLikes_{{ $post->id }}">{{ $post->likes }}</span> |
                        @endauth
                            
                        @guest
                            <strong>Likes:</strong> <i class="fa fa-heart-o" aria-hidden="true"></i> {{ $post->likes }} |
                        @endguest
                        <strong>Comments:</strong> {{ $post->comments->count() }}
                    </div>
                </div>
            </div>
        
        @endforeach
        </div>

        <div class="showMoreButton">
            <a href="javascript:void(0);" class="btn btn-success">Show More Posts&rarr;</a>
        </div>

    </div>
@endsection

@section('sorting')

<!-- Sorting Widget -->
<div id="sortWrapper" class="card my-4">
    <h5 class="card-header">Sorting by : </h5>
    <div class="card-body">
        
        <div class="form-check">
            <label class="form-check-label">
                <input name="sortDate" type="checkbox" class="form-check-input" value="date" autocomplete="off">Date
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input name="sortViews" type="checkbox" class="form-check-input" value="views" autocomplete="off">Views
            </label>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input name="sortLikes" type="checkbox" class="form-check-input" value="likes" autocomplete="off">Likes
            </label>
        </div>

    </div>
</div>

@endsection