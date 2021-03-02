var url = $('input[name="url"]').val();
$(document).on('click','.hide-video-btn',function(){

    // var bargainingValue = parseInt($(this).parent().find('.bargaining-value-input').val());
    var meta = $('#meta-token').attr('content');
    // console.log(bargainingValue);

    $.ajax({
        url: url + '/admin/hide-live',
        type: 'POST',
        data:{
            '_token': meta,
            //'bargainingValue': bargainingValue,

        },
        dataType: 'json',
        success: function(response){

        },
        error: function(response){
            console.log('error');
        },
    });
});