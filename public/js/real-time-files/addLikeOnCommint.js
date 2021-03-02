var likeOnCommentChannel = pusher.subscribe('like-on-commint-channel');
    likeOnCommentChannel.bind('add-like-on-commint', function(data) {
      console.log(JSON.stringify(data));
      //console.log($('#'+data.commintId).attr('id'));
      $('#'+data.commintId).next().find('.reply-reactions').find('.reactions').find('.all-react').text(data.likes);
      $('.informations-and-comments').find('#'+data.commintId).next().find('.reply-reactions').find('.reactions').find('.all-react').text(data.likes);

      var interactionSum = $('#'+data.commintId).next().find('.reply-reactions').find('.reactions').find('.'+data.interactionId).attr('data-content');
      if(data.likeStatus === true){
        /*
        *   the user didnt add like on this commint before
        *
        */

            $('#'+data.commintId).next()
                                 .find('.reply-reactions')
                                 .find('.reactions').find('.'+data.interactionId)
                                 .attr('data-content',parseInt(interactionSum)+1+' reactions');

            $('.informations-and-comments').find('#'+data.commintId).next()
                                 .find('.reply-reactions')
                                 .find('.reactions').find('.'+data.interactionId)
                                 .attr('data-content',parseInt(interactionSum)+1+' reactions');

       }else if(data.likeStatus === false){
        /*
        *   the user was added like on this commint before
        *
        */

            $('#'+data.commintId).next()
                                 .find('.reply-reactions')
                                 .find('.reactions').find('.'+data.interactionId)
                                 .attr('data-content',parseInt(interactionSum)-1+' reactions');

            $('.informations-and-comments').find('#'+data.commintId).next()
                                 .find('.reply-reactions')
                                 .find('.reactions').find('.'+data.interactionId)
                                 .attr('data-content',parseInt(interactionSum)-1+' reactions');

       }else{
        /*
        *   the user was added like and now changed the interaction on this commint
        *
        */
            // first get the number of the old reaction
            var oldInteractionSum = $('#'+data.commintId).next()
                                     .find('.reply-reactions')
                                     .find('.reactions').find('.'+data.oldInteractionId)
                                     .attr('data-content');
            // then minus 1 from the old reaction
            $('#'+data.commintId).next()
                                 .find('.reply-reactions')
                                 .find('.reactions').find('.'+data.oldInteractionId)
                                 .attr('data-content',parseInt(oldInteractionSum)-1+' reactions');

            $('.informations-and-comments').find('#'+data.commintId).next()
                                 .find('.reply-reactions')
                                 .find('.reactions').find('.'+data.oldInteractionId)
                                 .attr('data-content',parseInt(oldInteractionSum)-1+' reactions');

            // then add 1 to the new reaction
            $('#'+data.commintId).next()
                                 .find('.reply-reactions')
                                 .find('.reactions').find('.'+data.interactionId)
                                 .attr('data-content',parseInt(interactionSum)+1+' reactions');

            $('.informations-and-comments').find('#'+data.commintId).next()
                                 .find('.reply-reactions')
                                 .find('.reactions').find('.'+data.interactionId)
                                 .attr('data-content',parseInt(interactionSum)+1+' reactions');

       }
      
      //$('.video-container .actions .make-action .like-this .likes-span').text(data.likes);
      // $('.informations-and-comments .informations .winner .winner-name .winner-name-span').text(data.userName);

    });