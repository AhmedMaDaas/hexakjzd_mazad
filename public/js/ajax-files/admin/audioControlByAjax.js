var url = $('input[name="url"]').val();
var meta = $('#meta-token').attr('content');

// pause or play audio
    $(".audio-controls .pause").click(function(){

    	var imgFullPath = $(this).find("img").attr("src");
	    var arr = imgFullPath.split('/',3);
	    var imgPath = arr[0]+'//'+arr[2];

    	if($(this).attr('name') == 'pause'){

    		$(this).attr("name","start").find("img").attr("src",url+"/icons/play_arrow-24px.svg");

    		$.ajax({
	            url: url + '/admin/audio/pause',
	            type: 'POST',
	            data:{
	                '_token': meta,
	                //'timerPuse': hours+':'+minutes+':'+seconds,

	            },
	            dataType: 'json',
	            success: function(response){
	                
	            },
	            error: function(response){
	                console.log('error');
	            },
	        });

    	}else if($(this).attr("name")=="start"){

    		$(this).attr("name","pause").find("img").attr("src",url+"/icons/pause-24px.svg");

    		$.ajax({
	            url: url + '/admin/audio/play',
	            type: 'POST',
	            data:{
	                '_token': meta,
	                //'timerPuse': hours+':'+minutes+':'+seconds,

	            },
	            dataType: 'json',
	            success: function(response){
	                
	            },
	            error: function(response){
	                console.log('error');
	            },
	        });

    	}
    	

        // if($(this).attr("name")=="pause"){
        //    $(this).attr("name","start").find("img").attr("src",url+"/icons/play_arrow-24px.svg");
        // }else if($(this).attr("name")=="start"){
        //     $(this).attr("name","pause").find("img").attr("src",url+"/icons/pause-24px.svg");
        // }

    });

	//restart audio
	$(".audio-controls .restart").click(function(){
		var pauseButton = $(this).parent().find('.pause');
		//console.log(pauseButton.find('> img').attr('src'));

		if(pauseButton.attr('name')=='start'){
			//var imgFullPath = $(this).find("img").attr("src");
		    //var arr = imgFullPath.split('/',3);
		    //var url = arr[0]+'//'+arr[2];

		    pauseButton.find('img').attr("src",url+"/icons/pause-24px.svg");
		    pauseButton.attr('name','pause');
		}
        $.ajax({
            url: url + '/admin/audio/restart',
            type: 'POST',
            data:{
                '_token': meta,
                //'timerPuse': hours+':'+minutes+':'+seconds,

            },
            dataType: 'json',
            success: function(response){
                
            },
            error: function(response){
                console.log('error');
            },
        });
    });

	// stop audio
    $(".audio-controls .stop").click(function(){
        $.ajax({
	            url: url + '/admin/audio/stop',
	            type: 'POST',
	            data:{
	                '_token': meta,
	                //'timerPuse': hours+':'+minutes+':'+seconds,

	            },
	            dataType: 'json',
	            success: function(response){
	                
	            },
	            error: function(response){
	                console.log('error');
	            },
	        });
    });



    // // Start And Pause Audio In Live Page
    // $(".audio-controls .pause").click(function(){
    //     if($(this).attr("name")=="pause"){
    //         $("#live-player").get(0).play();
    //     }
    //     else{
    //         $("#live-player").get(0).pause();
    //     }
    // });
    
    // // Restart Audio In Live Admin Page
    // $(".audio-controls .restart").click(function(){
    //     $("#live-player").get(0).currentTime = 0;
    // });
    // // Stop Audio In Live Admin Page
    $(".audio-controls .stop").click(function(){
    	// var imgFullPath = $(this).find("img").attr("src");
	    // var arr = imgFullPath.split('/',3);
	    // var url = arr[0]+'//'+arr[2];

        //$("#live-player").get(0).pause();
        $(".timer-controls .pause,.audio-controls .pause").attr("name","start").find("img").attr("src",url+"/icons/play_arrow-24px.svg");
        //$("#live-player").get(0).currentTime = 0;
    });