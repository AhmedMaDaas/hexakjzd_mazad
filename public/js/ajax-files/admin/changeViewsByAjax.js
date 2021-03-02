var url = $('input[name="url"]').val();
$(document).on('click','.actions .views .robot-views .edit-views .form-btn',function(){
  	var cheatViews = parseInt($(this).parent().find('.input-robot-views').val());
  	var meta = $('#meta-token').attr('content');
  	console.log(cheatViews);

  	$.ajax({
      url: url + "/admin/change-views",
      type: 'POST',
      data: {
        '_token' : meta,
        'cheatViews': cheatViews,
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