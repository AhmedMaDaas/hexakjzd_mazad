
var userId = $('#user_id').val();
var notUserId = $('#not_user_id').val();

// Make a function to scroll to the last comment
/*function scrollNewComment() {
            $('.comments').animate({ 
                scrollTop: $(this).height()
                }, 500);
        }
*/
function scrollNewComment() {
  if($('.informations-and-comments .comments-container .comments').children(".comment").length > 0){
    $('.informations-and-comments .comments-container .comments').animate({ 
    scrollTop: $(".informations-and-comments .comments-container .comments")[0].scrollHeight
    
    }, 500);
    
}
}
var commintChannel = pusher.subscribe('add-commint-channel');
    commintChannel.bind('add-commint', function(data) {
      console.log(JSON.stringify(data));
      var notUserId = $('#not_user_id').val();

      $('#replace_commint_here').replaceWith(data.view);
      if(notUserId === undefined){
        $('.informations-and-comments').find('#replace_commint_here').replaceWith(data.view);
      }
      $("[data-toggle=popover]").popover();

      if(userId != data.userId){
        $('#'+data.commintId).find('.comment-body .control-icons > img').first().remove();
        // if(notUserId === undefined){
        //   $('.informations-and-comments').find('#'+data.commintId).find('.comment-body .control-icons > img').remove();
        // }
        if(notUserId === undefined){
          $('.informations-and-comments').find('#'+data.commintId).find('.comment-body .control-icons > img').remove();
          $('#'+data.commintId).find('.comment-body .control-icons .delete-icon').remove();
          $('.informations-and-comments').find('#'+data.commintId).find('.comment-body .control-icons .delete-icon').remove();
        }
      }
      if(notUserId === undefined || notUserId == data.userId){
        $('#'+data.commintId).find('.comment-body .control-icons > img').next().next().remove();
        $('.informations-and-comments').find('#'+data.commintId).find('.comment-body .control-icons > img').next().next().remove();
      }
      scrollNewComment();
      //$('.informations-and-comments .comments-container .comments').append(data.view);
    });