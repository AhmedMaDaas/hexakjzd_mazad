var url = $('input[name="url"]').val();

function sendReplyByAjax(thisVarParameter){
      var reply = thisVarParameter.parent().find('.reply-input').val();
      var commintId = thisVarParameter.parent().find('.commint-id').val();
      var meta = $('#meta-token').attr('content');
      console.log(commintId);
      // var commint = $('#commint').val();
      // var value = $('#value').val();
      // // console.log(commint);
      // // console.log(value);
      var thisVar = thisVarParameter;

      $.ajax({
        url: url + "/add-reply-on-commint",
        type: 'POST',
        data: {
          '_token' : meta,
          'reply': reply,
          'commintId' : commintId,
          //'button': button,
        }, 
        dataType: 'json',
        success: function (response) {
          thisVar.parent().find('.reply-input').val('');
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
$(".reply-form").keypress(function (e) {
  
    if ((e.keyCode == 13) && (e.target.type != "textarea")) {
      e.preventDefault();

      sendReplyByAjax($(this));

    }

  });


$(document).on('click','.comments .comment-footer .replies .reply-form .form-btn',function(){

  //$('.informations-and-comments .comments-container .comments .comment-footer .replies .reply-form .form-btn').click(function(){
      //console.log('s');

      sendReplyByAjax($(this));

      // var reply = $(this).parent().find('.reply-input').val();
      // var commintId = $(this).parent().find('.commint-id').val();
      // var meta = $('#meta-token').attr('content');
      // console.log(commintId);
      // // var commint = $('#commint').val();
      // // var value = $('#value').val();
      // // // console.log(commint);
      // // // console.log(value);
      // var thisVar = $(this);

      // $.ajax({
      //   url: url + "/add-reply-on-commint",
      //   type: 'POST',
      //   data: {
      //     '_token' : meta,
      //     'reply': reply,
      //     'commintId' : commintId,
      //     //'button': button,
      //   }, 
      //   dataType: 'json',
      //   success: function (response) {
      //     thisVar.parent().find('.reply-input').val('');
      //     //console.log(response.operation);
      //     //$('.modal-second').html(response.view);
      //   },
      //   error: function (response) {
      //     console.log("error ");
      //     //location.href="";
      //   },
      // });
  });