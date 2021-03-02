var url = $('input[name="url"]').val();
$('.like-on-live').click(function(){
    var meta = $('#meta-token').attr('content');
     //var interactionId = 1;
     //console.log('ss');

    $.ajax({
      url: url + "/like-on-live",
      type: 'POST',
      data: {
        '_token' : meta,
        //'commint': commint,
        //'value' : value,
        //'button': button,
      }, 
      dataType: 'json',
      success: function (response) {
        //console.log(response.operation);
        //$('.modal-second').html(response.view);
      },
      error: function (response) {
        console.log("error ");
        //location.href="";
      },
    });
});