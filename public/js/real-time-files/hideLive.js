var hideLiveChannel = pusher.subscribe('hide-live-channel');
    hideLiveChannel.bind('hide-live', function(data) {
      console.log(JSON.stringify(data));
      // alert($('.hide-video-btn').text());
      if(data.hide_live){
      	$('.hide-video').attr('style','display:inline;');
      	$('.hide-video-btn').text('UnHide Live');
      }else{
      	$('.hide-video').attr('style','display:none;');
      	$('.hide-video-btn').text('Hide Live');
      }
      	
      // $('#'+data.commintId).find('.content').text(data.commint);
      // $('.informations-and-comments').find('#'+data.commintId).find('.content').text(data.commint);
      //$('.video-container .actions .make-action .like-this .likes-span').text(data.likes);
      // $('.informations-and-comments .informations .winner .winner-name .winner-name-span').text(data.userName);

    });