var url = $('input[name="url"]').val();
// set user id from commint to block it
$(document).on('click', ".comment .comment-body .control-icons .block-icon", function() {
    var userId = $(this).parent().find('.user-input').val();
    $('#blocked-person').val(userId);
    console.log(userId);
    
}); 

// set user id from reply to block it
$(document).on('click', ".replies .reply .reply-body .control-icons .block-icon", function() {
    var userId = $(this).parent().find('.user-input').val();
    $('#blocked-person').val(userId);
    console.log(userId);
});


$(document).on('click','#blockModal .modal-dialog .modal-content .modal-footer .btn-primary',function(){
    $('.class2').modal('hide');
    var userId = $('#blocked-person').val();
    var meta = $('#meta-token').attr('content');


    $.ajax({
        url: url + '/admin/block',
        type: 'POST',
        data:{
            '_token': meta,
            'userId': userId,

        },
        dataType: 'json',
        success: function(response){

        },
        error: function(response){
            console.log('error');
        },
    });

});