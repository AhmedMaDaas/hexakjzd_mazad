var editCommintChannel = pusher.subscribe('edit-commint-channel');
    editCommintChannel.bind('edit-commint', function(data) {
      console.log(JSON.stringify(data));
      $('#'+data.commintId).find('.content').text(data.commint);
      $('.informations-and-comments').find('#'+data.commintId).find('.content').text(data.commint);
      //$('.video-container .actions .make-action .like-this .likes-span').text(data.likes);
      // $('.informations-and-comments .informations .winner .winner-name .winner-name-span').text(data.userName);

    });