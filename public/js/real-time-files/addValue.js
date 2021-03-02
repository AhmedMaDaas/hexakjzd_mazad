var valueChannel = pusher.subscribe('add-value-channel');
    valueChannel.bind('add-value', function(data) {
      console.log(JSON.stringify(data));
      //var min_value = $('.min_value').val();

      $('.informations .prices .max').text(data.bigValue+'$');
      $('.informations .prices .min').text(data.minValue+'$');

      if(parseInt(data.bigValue) != 0){

        $('#direct-value').val(parseInt(data.bigValue)+parseInt(data.bargainingValue)+'$');
        $('.informations-and-comments').find('#direct-value').val(parseInt(data.bigValue)+parseInt(data.bargainingValue)+'$');

      }else{

        $('#direct-value').val(parseInt(data.minValue)+'$');
        $('.informations-and-comments').find('#direct-value').val(parseInt(data.minValue)+'$');
      }
      	

      
	  $('.control-direct-value .min-direct').text(data.bargainingValue+'$');

      $('.informations .winner .winner-name .winner-name-span').text(data.userName);
      $('#winner_user_id').val(data.userId);


    });