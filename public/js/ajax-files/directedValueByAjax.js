var url = $('input[name="url"]').val();
$('.direct-value').click(function(){
    var value = $('#direct-value').val();
    var meta = $('#meta-token').attr('content');
    value = parseInt(value);//value.slice(0, -1);
    console.log(value);

    $.ajax({
      url: url + "/add-commint",
      type: 'POST',
      data: {
        '_token' : meta,
        //'commint': commint,
        'value' : value,
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
