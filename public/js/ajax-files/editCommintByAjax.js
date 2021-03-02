var url = $('input[name="url"]').val();

function editCommintByAjax(thisVarParameter){
    var editedCommint = thisVarParameter.parent().find('.comment-content').val();
        var commintId = thisVarParameter.parent().parent().attr('id');
        var meta = $('#meta-token').attr('content');
        console.log(commintId);

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

$(document).on("click",".comments .comment .edit-comment-form .form-btn",function(){

    editCommintByAjax($(this));
    
    // var editedCommint = $(this).parent().find('.comment-content').val();
    // var commintId = $(this).parent().parent().attr('id');
    // var meta = $('#meta-token').attr('content');
    // console.log(commintId);

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

$(".edit-comment-form .comment-content").keypress(function (e) {
    if ((e.keyCode == 13) && (e.target.type != "textarea")) {
        e.preventDefault();

        editCommintByAjax($(this));

    }

});