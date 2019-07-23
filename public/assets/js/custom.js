/**
 * @param entity
 * @param url
 * @param id
 * @param likeAjaxUrl
 */
function showMorePosts(entity, url, id, likeAjaxUrl)
{
    jQuery.ajax({
    	url : url,
    	headers: {
	        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
	    },
    	method: 'POST',
    	dataType: 'JSON',
    	data: {
    		entity: entity,
    		id: id,
    		visible: jQuery('#postsListWrapper .postItem:visible').length,
    		sortDate: jQuery('input[name=sortDate]').is(':checked'),
    		sortViews: jQuery('input[name=sortViews]').is(':checked'),
    		sortLikes: jQuery('input[name=sortLikes]').is(':checked'),
    	},
    	success: function(response) {
    		if (response.code === 1) {
    			jQuery('#postsListWrapper').append(response.html);

				jQuery('.likePostLink').on('click', function() {
					likePost(jQuery(this).closest('.info').find('input.postId').val(), likeAjaxUrl);
				});
    		}
    	},
    	error: function(response) {
			console.log('ERROR');
			console.log(response);
    	}
    });
}

/**
 * @param entity
 * @param url
 * @param id
 * @param likeAjaxUrl
 */
function sortingPosts(entity, url, id, likeAjaxUrl)
{
	jQuery.ajax({
    	url : url,
    	headers: {
	        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
	    },
    	method: 'POST',
    	dataType: 'JSON',
    	data: {
    		entity: entity,
    		id: id,
    		visible: jQuery('#postsListWrapper .postItem:visible').length,
    		sortDate: jQuery('input[name=sortDate]').is(':checked'),
    		sortViews: jQuery('input[name=sortViews]').is(':checked'),
    		sortLikes: jQuery('input[name=sortLikes]').is(':checked'),
    	},
    	success: function(response) {
    		if (response.code === 1) {
    			jQuery('#postsListWrapper').html(response.html);

				jQuery('.likePostLink').on('click', function() {
					likePost(jQuery(this).closest('.info').find('input.postId').val(), likeAjaxUrl);
				});
    		}
    	},
    	error: function(response) {
			console.log('ERROR');
			console.log(response);
    	}
    });
}

/**
 * @param postId
 * @param commentAjaxUrl
 * @param answerAjaxUrl
 */
function sendComment(postId, commentAjaxUrl, answerAjaxUrl)
{
    jQuery.ajax({
        url : commentAjaxUrl,
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        dataType: 'JSON',
        data: {
            postId: postId,
            commentContent: jQuery('#commentForm textarea').val()
        },
        success: function(response) {

            if (response.code === 1) {
                jQuery('#commentsWrapper').prepend(response.html);
                jQuery('.collapse').collapse({
					toggle: false
				});

				jQuery('#comment_'+response.commentId+'_AnswerForm form').on('submit', function(event) {
					event.preventDefault();
					event.stopPropagation();
					sendAnswer(jQuery('#currentPostId').val(), this, answerAjaxUrl);
				});

				jQuery('#commentForm textarea').val('');
            } else {
            	alert("Error save data!!!");
			}
        },
        error: function(response) {
            console.log('ERROR');
            console.log(response);
			alert("Error save data!!!");
        }
    });
}

/**
 * @param postId
 * @param object
 * @param ajaxUrl
 */
function sendAnswer(postId, object, ajaxUrl) {
	let commentId = jQuery(object).closest('.answerForm').find('input.commentId').val();
	let answerContent = jQuery(object).closest('.answerForm').find('textarea').val();
	jQuery.ajax({
		url : ajaxUrl,
		headers: {
			'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
		},
		method: 'POST',
		dataType: 'JSON',
		data: {
			postId: postId,
			commentId: commentId,
			answerContent: answerContent
		},
		success: function(response) {
			if (response.code === 1) {
				jQuery('.answersWrapper[data-comment-id='+commentId+']').prepend(response.html);

				jQuery(object).closest('.answerForm').find('textarea').val('');
			} else {
				alert("Error save data!!!");
			}
		},
		error: function(response) {
			console.log('ERROR');
			console.log(response);
			alert("Error save data!!!");
		}
	});
}

/**
 * @param postId
 * @param ajaxUrl
 */
function likePost(postId, ajaxUrl)
{
	jQuery.ajax({
		url : ajaxUrl,
		headers: {
			'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
		},
		method: 'POST',
		dataType: 'JSON',
		data: {
			postId: postId
		},
		success: function(response) {
			if (response.code === 1) {
				jQuery('#postLikes_'+postId).html(response.likes);
			} else {
				alert("Error save data!!!");
			}
		},
		error: function(response) {
			console.log('ERROR');
			console.log(response);
			alert("Error save data!!!");
		}
	});
}