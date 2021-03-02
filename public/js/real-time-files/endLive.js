var url = $('input[name="url"]').val();
var userId = $('#user_id').val();

var endLiveChannel = pusher.subscribe('end-live-channel');
    endLiveChannel.bind('end-live', function(data) {
      console.log(JSON.stringify(data));
      //document.body.remove();
      
      if(userId !== undefined) location.replace(url+"/welcome");
      else location.reload(true);

    });