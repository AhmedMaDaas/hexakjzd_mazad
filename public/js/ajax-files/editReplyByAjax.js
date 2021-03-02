var url = $('input[name="url"]').val();

function editReplyByAjax(thisVarParameter){

    var editedCommint = thisVarParameter.parent().find('.reply-content').val();
    var commintId = thisVarParameter.parent().parent().attr('id');
    var meta = $('#meta-token').attr('content');
    console.log(editedCommint);

    $.ajax({
        url: url + '/edit-commint',
        type: 'POST',
        data:{
            '_token': meta,
            'editedCommint': editedCommint,
            'commintId': commintId,

        },
        dataType: 'json',
        success: function(response){

        },
        error: function(response){
            console.log('error');
        },
    });

}


$(document).on("click",".replies .reply .edit-reply-form .form-btn",function(){

    editReplyByAjax($(this));
    
    // var editedCommint = $(this).parent().find('.reply-content').val();
    // var commintId = $(this).parent().parent().attr('id');
    // var meta = $('#meta-token').attr('content');
    // console.log(editedCommint);

    // $.ajax({
    //     url: url + '/edit-commint',
    //     type: 'POST',
    //     data:{
    //         '_token': meta,
    //         'editedCommint': editedCommint,
    //         'commintId': commintId,

    //     },
    //     dataType: 'json',
    //     success: function(response){

    //     },
    //     error: function(response){
    //         console.log('error');
    //     },
    // });
    
});

$(".edit-reply-form .reply-content").keypress(function (e) {
    if ((e.keyCode == 13) && (e.target.type != "textarea")) {
        e.preventDefault();

        editReplyByAjax($(this));

    }

});