var url = $('input[name="url"]').val();
// set commint id to delete it
$(document).on('click', ".comment .comment-body .control-icons .delete-icon", function() {
    var commintId = $(this).parent().parent().parent().attr('id');
    $('#deleted-commint-reply').val(commintId);
    //console.log($('#deleted-commint-reply').val());
    //var meta = $('#meta-token').attr('content');
    // console.log(commintId);

    //     $.ajax({
    //         url: '/delete-commint',
    //         type: 'POST',
    //         data:{
    //             '_token': meta,
    //             'commintId': commintId,

    //         },
    //         dataType: 'json',
    //         success: function(response){

    //         },
    //         error: function(response){
    //             console.log('error');
    //         },
    //     });
    // $(this).parents().eq(3).next().remove();
    // $(this).parents().eq(3).remove();
}); 


// set reply id to delete it
$(document).on('click', ".replies .reply .reply-body .control-icons .delete-icon", function() {
        var commintId = $(this).parent().parent().parent().attr('id');
        $('#deleted-commint-reply').val(commintId);
        // var meta = $('#meta-token').attr('content');
        //console.log($('#deleted-commint-reply').val());

        
        // console.log("hi");
        // $(this).parents().eq(3).remove();
    });


$(document).on('click','#deleteModal .modal-dialog .modal-content .modal-footer .btn-primary',function(){
	$('.classl').modal('hide');
	var commintId = $('#deleted-commint-reply').val();
	var meta = $('#meta-token').attr('content');

	$.ajax({
        url: url +'/delete-commint',
        type: 'POST',
        data:{
            '_token': meta,
            'commintId': commintId,

        },
        dataType: 'json',
        success: function(response){

        },
        error: function(response){
            console.log('error');
        },
    });

});
