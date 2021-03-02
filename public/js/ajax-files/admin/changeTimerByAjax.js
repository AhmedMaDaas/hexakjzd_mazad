var url = $('input[name="url"]').val();
//  edit timer
$(document).on('click','.informations-and-comments .time-container .edit-timer .form-btn',function(){
	var hours   = $(this).parent().find('.edit-hours .hours').val();
	var minutes = $(this).parent().find('.edit-minutes .minutes').val();
	var seconds = $(this).parent().find('.edit-seconds .seconds').val();

	var meta = $('#meta-token').attr('content');
	if(!hours)
		hours = '00';
	if(!minutes)
		minutes = '00';
	if(!seconds)
		seconds = '00';
	
		console.log(hours+':'+minutes+':'+seconds);

	$.ajax({
        url: url + '/admin/change-timer',
        type: 'POST',
        data:{
            '_token': meta,
            'timer': hours+':'+minutes+':'+seconds,

        },
        dataType: 'json',
        success: function(response){

        },
        error: function(response){
            console.log('error');
        },
    });
});


//pause and start timer
$(document).on('click','.informations-and-comments .time-container .timer-controls .pause',function(){

    var meta = $('#meta-token').attr('content');

    if($(this).attr('name') == 'pause'){
        var hours = $('#ending_hours').text();
        var minutes = $('#ending_minutes').text();
        var seconds = $('#ending_seconds').text();

        
        console.log(hours+':'+minutes+':'+seconds);

        $.ajax({
            url: url + '/admin/pause-timer',
            type: 'POST',
            data:{
                '_token': meta,
                'timerPuse': hours+':'+minutes+':'+seconds,

            },
            dataType: 'json',
            success: function(response){
                
            },
            error: function(response){
                console.log('error');
            },
        });

    }else{
        $.ajax({
            url: url + '/admin/play-timer',
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

    var imgFullPath = $(this).find("img").attr("src");
    var arr = imgFullPath.split('/',3);
    var imgPath = arr[0]+'//'+arr[2];

    //console.log(imgPath);
    if($(this).attr("name")=="pause"){
        $(this).attr("name","start").find("img").attr("src",url+"/icons/play_arrow-24px.svg");
        //console.log($(this).find("img").attr("src"));
    }else if($(this).attr("name")=="start"){
        $(this).attr("name","pause").find("img").attr("src",url+"/icons/pause-24px.svg");
        //console.log($(this).find("img").attr("src"));
    }
	
});

// restart timer 
$(document).on('click','.informations-and-comments .time-container .timer-controls .restart',function(){

    var meta = $('#meta-token').attr('content');

    $.ajax({
        url: url + '/admin/restart-timer',
        type: 'POST',
        data:{
            '_token': meta,

        },
        dataType: 'json',
        success: function(response){

        },
        error: function(response){
            console.log('error');
        },
    });

    if($(this).prev().attr("name")=="start"){
        $(this).prev().attr("name","pause").find("img").attr("src",url+"/icons/pause-24px.svg");
        //console.log($(this).find("img").attr("src"));
    }
});


// stopn timer
$(document).on('click','.informations-and-comments .time-container .timer-controls .stop',function(){

    var meta = $('#meta-token').attr('content');

    $.ajax({
        url: url + '/admin/stop-timer',
        type: 'POST',
        data:{
            '_token': meta,

        },
        dataType: 'json',
        success: function(response){

        },
        error: function(response){
            console.log('error');
        },
    });

    if($(this).next().attr("name")=="pause"){
        $(this).next().attr("name","start").find("img").attr("src",url+"/icons/play_arrow-24px.svg");
        //console.log($(this).find("img").attr("src"));
    }
});