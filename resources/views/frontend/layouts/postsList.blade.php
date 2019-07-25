@foreach ($posts as $post)

<div class="card mb-4 postItem">
	<img class="card-img-top" src="{{ url('/storage/images/'.$post->thumbnail) }}" alt="{{ $post->title }}">
	<div class="card-body">
		<h2 class="card-title">{{ $post->title }}[{{ $post->id }}]</h2>
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
				<span id="postLikes_{{ $post->id }}">{{ $post->like->count() }}</span> |
			@endauth
				
			@guest
				<strong>Likes:</strong> <i class="fa fa-heart-o" aria-hidden="true"></i> {{ $post->like->count() }} |
			@endguest
			
			<strong>Comments:</strong> {{ $post->comments->count() }}
		</div>
	</div>
</div>

@endforeach