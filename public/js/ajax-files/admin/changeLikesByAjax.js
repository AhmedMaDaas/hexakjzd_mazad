var url = $('input[name="url"]').val();
$(document).on('click','.actions .make-action .robot-likes .edit-likes .form-btn',function(){
	var cheatedLikes = $(this).parent().find('.input-robot-likes').val();
	var meta = $('#meta-token').attr('content');
	console.log(cheatedLikes);

	$.ajax({
      url: url + "/admin/change-likes",
      type: 'POST',
      data: {
        '_token' : meta,
        'cheatedLikes': cheatedLikes,
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