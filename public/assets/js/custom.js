function showMorePosts(entity, url, id)
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
    		}
    	},
    	error: function(response) {
			console.log('ERROR');
			console.log(response);
    	}
    	
    });
}
