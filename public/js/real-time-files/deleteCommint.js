var deleteCommintChannel = pusher.subscribe('delete-commint-channel');
    deleteCommintChannel.bind('delete-commint', function(data) {
        if(data.reply){
            console.log(JSON.stringify(data));

            var repliesNum = parseInt($('#'+data.commintId).parent().prev().find('.reply > span').text());

            console.log($('#'+data.commintId).parent().find('.reply').length);
            if($('#'+data.commintId).parent().find('.reply').length <= 2 ){

                $('#'+data.commintId).parent().find('.show-more').css("display","none");
                $('.informations-and-comments').find('#'+data.commintId).parent().find('.show-more').css("display","none");
            }

            if(repliesNum > 0){

                $('#'+data.commintId).parent().prev().find('.reply > span').text(repliesNum-1+' reply');
                $('.informations-and-comments').find('#'+data.commintId).parent().prev().find('.reply > span').text(repliesNum-1+' reply');

            }else{

                $('#'+data.commintId).parent().prev().find('.reply > span').text('0 reply');
                $('.informations-and-comments').find('#'+data.commintId).parent().prev().find('.reply > span').text('0 reply');
            }


            $('#'+data.commintId).remove();
            $('.informations-and-comments').find('#'+data.commintId).remove();

        }else{
            console.log(JSON.stringify(data));
            $('#'+data.commintId).next().remove();
            $('.informations-and-comments').find('#'+data.commintId).next().remove();

            $('#'+data.commintId).remove();
            $('.informations-and-comments').find('#'+data.commintId).remove();
        }
      
      //$('.video-container .actions .make-action .like-this .likes-span').text(data.likes);
      // $('.informations-and-comments .informations .winner .winner-name .winner-name-span').text(data.userName);

    });