var url = $('input[name="url"]').val();
$(document).on('click','.informations .prices .edit-min-price .form-btn ',function(){
  	var minValue = parseInt($(this).parent().find('.min-price').val());
  	var meta = $('#meta-token').attr('content');
  	console.log(minValue);

  	$.ajax({
      url: url + "/admin/change-min-value",
      type: 'POST',
      data: {
        '_token' : meta,
        'minValue': minValue,
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