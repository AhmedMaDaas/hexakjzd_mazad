var url = $('input[name="url"]').val();
$(document).on('click', '.comments .comment-footer .reply-reactions .reactions > a > img', function(){
//$(".informations-and-comments .comments-container .comments .comment-footer .reply-reactions .reactions > a > img").click(function(){
    var interactionId = parseInt($(this).attr('class'));
    var commintId = $(this).parent().parent().parent().parent().prev().attr('id');
    var meta = $('#meta-token').attr('content');
    //console.log(interactionId);

    $.ajax({
        url: url + '/like-on-commint',
        type: 'post',
        data:{

            '_token' : meta,
            'interactionId': interactionId,
            'commintId': commintId,
        },
        dataType: 'json',
        success: function(response){

        },
        error: function(response){
            console.log("error ");
        },

    });

    if($(this).hasClass("react")){

    }else{

        
    }
   
});