var userId = $('#user_id').val();
var notUserId = $('#not_user_id').val();

var replyChannel = pusher.subscribe('add-reply-channel');
    replyChannel.bind('add-reply', function(data) {
      console.log(JSON.stringify(data));
      console.log(notUserId);
      //console.log($('#'+data.commintParentId).next().find('.replies').find('.replace_reply_here').attr('class'));
      $('#'+data.commintParentId).next().find('.replies').find('.replace_reply_here').replaceWith(data.view);
      if(notUserId === undefined){
        $('.informations-and-comments').find('#'+data.commintParentId).next().find('.replies').find('.replace_reply_here').replaceWith(data.view);
      }
      
      //display edit icon if the user is same who replaied
      if(userId != data.userId){
        $('#'+data.commintId).find('.reply-body .control-icons > img').first().remove();
        
        if(notUserId === undefined){
          $('.informations-and-comments').find('#'+data.commintId).find('.reply-body .control-icons > img').remove();
          $('#'+data.commintId).find('.reply-body .control-icons .delete-icon').remove();
          $('.informations-and-comments').find('#'+data.commintId).find('.reply-body .control-icons .delete-icon').remove();
        }
      }
      if(notUserId === undefined || notUserId == data.userId){
        $('#'+data.commintId).find('.reply-body .control-icons > img').next().next().remove();
        $('.informations-and-comments').find('#'+data.commintId).find('.reply-body .control-icons > img').next().next().remove();
      }

      //disply show more if there is more than 1 commints
      if($('#'+data.commintParentId).next().find('.replies .reply').length > 1 ){
            $('#'+data.commintParentId).next().find('.replies .show-more').css("display","block");
            if(notUserId === undefined){
              $('.informations-and-comments').find('#'+data.commintParentId).next().find('.replies .show-more').css("display","block");
            }
            
        }

      var repliesNum = parseInt($('#'+data.commintParentId).next().find('.reply-reactions .reply > span').text());
      $('#'+data.commintParentId).next().find('.reply-reactions .reply > span').text(repliesNum+1+' reply');
      $('.informations-and-comments').find('#'+data.commintParentId).next().find('.reply-reactions .reply > span').text(repliesNum+1+' reply');
      //$('#replace_reply_here').replaceWith(data.view);
      //scrollNewComment();
      //$('.informations-and-comments .comments-container .comments').append(data.view);
    });