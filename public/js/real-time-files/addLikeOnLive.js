var likeOnLiveChannel = pusher.subscribe('like-on-live-channel');
    likeOnLiveChannel.bind('add-like-on-live', function(data) {
      console.log(JSON.stringify(data));
      $('.actions .make-action .like-this .likes-span').text(data.likes);
      // $('.informations-and-comments .informations .winner .winner-name .winner-name-span').text(data.userName);

    });