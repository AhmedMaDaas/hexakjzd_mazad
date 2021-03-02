var url = $('input[name="url"]').val();
$(document).on('click','.comments-robots .comments-robots-container .comment-robot .card-body .btn',function(){
	var robotId = $(this).parent().find('.robot-id-input').val();
	var robotCommintId = $(this).parent().find('.commint-robot-id-input').val();
	var meta = $('#meta-token').attr('content');

	console.log(robotId);
	console.log(robotCommintId);

	$.ajax({
      url: url + "/admin/add-robot-commint",
      type: 'POST',
      data: {
        '_token' : meta,
        'robotId': robotId,
        'robotCommintId': robotCommintId,
        //'value' : value,
        //'button': button,
      }, 
      dataType: 'json',
      success: function (response) {
        //$('#commint').val('');
        //console.log(response.operation);
        //$('.modal-second').html(response.view);
      },
      error: function (response) {
        console.log("error ");
        //location.href="";
      },
    });
});