var url = $('input[name="url"]').val();
$(document).on('click','.control-direct-value .bargaining-value-form .form-btn',function(){

    var bargainingValue = parseInt($(this).parent().find('.bargaining-value-input').val());
    var meta = $('#meta-token').attr('content');
    console.log(bargainingValue);

    $.ajax({
        url: url + '/admin/change-bargaining-value',
        type: 'POST',
        data:{
            '_token': meta,
            'bargainingValue': bargainingValue,

        },
        dataType: 'json',
        success: function(response){

        },
        error: function(response){
            console.log('error');
        },
    });
});