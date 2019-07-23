<div class="media mb-4">
    <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
    <div class="media-body">
        <h5 class="mt-0">{{ $author->name }}</h5>
        {{ $comment->content }}
        <div>
            <a data-toggle="collapse" href="#comment_{{ $comment->id }}_AnswerForm" role="button" aria-expanded="false" aria-controls="comment_{{ $comment->id }}_AnswerForm">
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
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <div class="answersWrapper" data-comment-id="{{ $comment->id }}"></div>
    </div>
</div>