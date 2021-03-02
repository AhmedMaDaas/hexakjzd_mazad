  var url = $('input[name="url"]').val();

  function sendCommintByAjax(thisVarParameter){
      var commint = thisVarParameter.parent().find('#commint').val();
          var value = thisVarParameter.parent().find('#value').val();
          var meta = $('#meta-token').attr('content');
          console.log(commint);
          console.log(value);

          var thisVar = thisVarParameter;

          $.ajax({
            url: url + "/add-commint",
            type: 'POST',
            data: {
              '_token' : meta,
              'commint': commint,
              'value' : value,
              //'button': button,
            }, 
            dataType: 'json',
            success: function (response) {
              $('#commint').val('');
              thisVar.parent().find('#commint').val('');
              //console.log(response.operation);
              //$('.modal-second').html(response.view);
            },
            error: function (response) {
              console.log("error ");
              //location.href="";
            },
          });
}
  
  //canceled the request and translate to ajax request
$(".add-comment").keypress(function (e) {
    if ((e.keyCode == 13) && (e.target.type != "textarea")) {

        e.preventDefault();

        sendCommintByAjax($(this));

    } 
    
});

  $(document).on('click', '.add-comment .add-commint', function(){
	//$('#submit-btn').click(function(){

        sendCommintByAjax($(this));
        // var commint = $(this).parent().find('#commint').val();
        // var value = $(this).parent().find('#value').val();
        // var meta = $('#meta-token').attr('content');
        // console.log(commint);
        // console.log(value);

        // var thisVar = $(this);

        // $.ajax({
        //   url: url + "/add-commint",
        //   type: 'POST',
        //   data: {
        //     '_token' : meta,
        //     'commint': commint,
        //     'value' : value,
        //     //'button': button,
        //   }, 
        //   dataType: 'json',
        //   success: function (response) {
        //     $('#commint').val('');
        //     thisVar.parent().find('#commint').val('');
        //     //console.log(response.operation);
        //     //$('.modal-second').html(response.view);
        //   },
        //   error: function (response) {
        //     console.log("error ");
        //     //location.href="";
        //   },
        // });
    });