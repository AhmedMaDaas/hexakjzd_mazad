var userIdBySession = $('#user_id').val();

var blockUserChannel = pusher.subscribe('block-user-channel');
    blockUserChannel.bind('block-user', function(data) {
      console.log(JSON.stringify(data));
      var commintsIds = data.commintsIds;

      if(userIdBySession == data.userId)
      		location.href="/sss";

      for(i=0;i<commintsIds.length;i++){
      	var fullClass = $('#'+commintsIds[i]).attr('class');
        
      	if (fullClass !== undefined){
            var classes = fullClass.split(" ");
            var myClass = classes[classes.length-1];
            if(myClass == 'comment'){
              
              //console.log($('#'+commintsIds[i]).next().attr('class'));
              //$('#'+commintsIds[i]).next().attr('style','visibility:hidden;');
              $('#'+commintsIds[i]).next().remove();
              $('.informations-and-comments').find('#'+commintsIds[i]).next().remove();
              
            }
            $('#'+commintsIds[i]).remove();
            $('.informations-and-comments').find('#'+commintsIds[i]).remove();
        }
      	
      }
      

    });