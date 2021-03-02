var audioControlChannel = pusher.subscribe('audio-control-channel');
    audioControlChannel.bind('audio-control', function(data) {
      console.log(JSON.stringify(data));
      if(data.pause){

      	$("#live-player").get(0).pause();
      	//$(".audio-modal-live").attr('name','pause');

      }else if(data.play){
      	$(".audio-modal-live").modal('show');
      	$("#live-player").get(0).play();
      	$(".audio-modal-live").attr('name','start');
      	


      }else if(data.restart){
      	$(".audio-modal-live").modal('show');
      	$("#live-player").get(0).currentTime = 0;
      	$("#live-player").get(0).play();
      	$(".audio-modal-live").attr('name','restart');

      }else if(data.stop){

      	$("#live-player").get(0).pause();
		$("#live-player").get(0).currentTime = 0;
      	//$(".audio-modal-live").attr('name','stop');
      }

     

    });

    $(".audio-modal-live .modal-dialog .modal-content .modal-footer .allow").click(function(){
  		var name = $(".audio-modal-live").attr('name');

  		$(".audio-modal-live").modal('hide');

  		if(name == 'start'){
  			
        	$("#live-player").get(0).play();

  		}else if(name == 'pause'){

  			//$("#live-player").get(0).pause();
  		}else if(name == 'restart'){

  			$("#live-player").get(0).currentTime = 0;
  			$("#live-player").get(0).play();

  		}else if(name == 'stop'){

  			// $("#live-player").get(0).pause();
  			// $("#live-player").get(0).currentTime = 0;
  		}
        
    });