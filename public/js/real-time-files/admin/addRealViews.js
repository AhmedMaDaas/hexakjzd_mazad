var viewChannel = pusher.subscribe('add-view-channel');
    viewChannel.bind('add-view', function(data) {
      console.log(JSON.stringify(data));
      $('.actions .views .real-views-span').text(data.views);
      $('.actions .views .cheat-views-span').text(data.cheat_views);
      //var min_value = $('.min_value').val();

      // $('.informations-and-comments .informations .prices .max').text(data.bigValue+'$');
      // $('.informations-and-comments .informations .prices .min').text(data.minValue+'$');
      // $('#direct-value').val(parseInt(data.bigValue)+ parseInt(data.minValue)+'$');
      // $('.informations-and-comments .informations .winner .winner-name .winner-name-span').text(data.userName);
      //$('#winner_user_id').val(data.userId);


    });