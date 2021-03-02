var likeOnLiveChannel = pusher.subscribe('like-on-live-channel');
    likeOnLiveChannel.bind('add-like-on-live', function(data) {
      console.log(JSON.stringify(data));
      $('.video-container .actions .make-action .like-this .real-likes .real-likes-span').text(data.likes - data.cheatLikes);
      $('.video-container .actions .make-action .like-this .robot-likes .robot-likes').text(data.cheatLikes);
      
      // $('.informations-and-comments .informations .winner .winner-name .winner-name-span').text(data.userName);

    });