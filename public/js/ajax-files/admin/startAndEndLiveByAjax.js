var url = $('input[name="url"]').val();
// start the live and the auction
$(document).on('click','.start-live > a',function(){

    var meta = $('#meta-token').attr('content');

    $.ajax({
        url: url + '/admin/start-live',
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
});

// end the live and the auction
$(document).on('click','.end-live > a',function(){

    var meta = $('#meta-token').attr('content');

    $.ajax({
        url: url + '/admin/end-live',
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
});