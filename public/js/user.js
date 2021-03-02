$(document).ready(function(){
    /** Start Live Page **/
    $("[data-toggle=popover]").popover();
    /*$(".comments").niceScroll({
        cursorwidth:"3px",
        cursorcolor: "#B9B9B9",
        cursoropacitymin: 0.3,
        background: "#f5f5f5",
        cursorborder: "0",
        autohidemode: false,
        horizrailenabled: false,
        zindex: 99999
    });*/
    // Display span when hover on dropdown menu image
   /*$(".dropdown-menu-swiper-container .dropdown-menu-links .link-container > a > img").mouseenter(function(){
        $(this).parent().parent().find("p").css("display","block");
    });
    $(".dropdown-menu-swiper-container .dropdown-menu-links .link-container > a > img").mouseleave(function(){
        $(this).parent().parent().find("p").css("display","none");
    });*/
    // Slide up and down for dropdown menu
    $(".dropdown-menu-swiper-container .arrow-container > img").click(function(){
        if($(this).hasClass("down")){
            $(this).removeClass("down");
            $(this).parent().animate({
                "top":"20%"
            },500,function(){
                    $(this).find("img").css("transform","rotate(180deg)");
                }).parent().animate({height:"100px"}).parent().find(".dropdown-menu-links").css("visibility","visible");
            }
        
            else{
                $(this).addClass("down");
                $(this).parent().animate({
                    "top":"-10%"
                },500,function(){
                        $(this).find("img").css("transform","rotate(0deg)");
                    }).parent().animate({height:"40px"}).parent().find(".dropdown-menu-links").css("visibility","hidden");
            }});
    // For Mobile
    $(".dropdown-menu-swiper-container-mobile .arrow-container > img").click(function(){
        if($(this).hasClass("down")){
            $(this).removeClass("down");
            $(this).parent().animate({
                "top":"20%"
            },500,function(){
                    $(this).find("img").css("transform","rotate(180deg)");
                }).parent().animate({height:"75px"}).parent().find(".dropdown-menu-links").css("visibility","visible");
            }
        
            else{
                $(this).addClass("down");
                $(this).parent().animate({
                    "top":"-10%"
                },500,function(){
                        $(this).find("img").css("transform","rotate(0deg)");
                    }).parent().animate({height:"40px"}).parent().find(".dropdown-menu-links").css("visibility","hidden");
            }});
        // React Play Sound
        $(document).on('click',".informations-and-comments .comments-container .comments .comment-footer .reply-reactions .reactions > a > img,.comments-container .comments .comment-footer .reply-reactions .reactions > a > img",function(){
        //$(".informations-and-comments .comments-container .comments .comment-footer .reply-reactions .reactions > a > img,.comments-container .comments .comment-footer .reply-reactions .reactions > a > img").click(function(){
            $("#react-sound").get(0).play(); 
            if($(this).hasClass("react")){
                $(this).removeClass("react");
            }else{
                $(this).addClass("react");
                $(this).parent().siblings().each(function(){
                    $(this).find("img").removeClass("react");
                });
            }
           
        });
        // Show Reply And Hide
        $(document).on('click',".comment-footer .reply-reactions .reply > span",function(){
            alert('s');
        //$(".comment-footer .reply-reactions .reply > span").click(function(){
           $(this).parent().parent().parent().find(".replies").toggle(100);
        });
        // Display show more link if there is replies
        $(".replies").each(function(){
            if(($(this).children('.reply').length > 0) && ($(this).children('.reply').length != $(this).children('.reply:visible').length)){
                $(this).find('.show-more').css("display","block");
            }
        });
        
        // Display specific number of replies
        $(document).on('click','.show-more',function(){
        //$('.replies').find(".show-more").click(function () {
            $(this).siblings(".reply:hidden").slice(0, 2).show();
            if ($(this).siblings(".reply").length == $(this).siblings(".reply:visible").length) {
                $(this).hide();
            }
        });
    // Edit Comment
    $(document).on('click',".informations-and-comments .comments-container .comments .comment .comment-body .control-icons .edit-icon,.comments-container .comments .comment .comment-body .control-icons .edit-icon",function(){
    //$(".informations-and-comments .comments-container .comments .comment .comment-body .control-icons .edit-icon,.comments-container .comments .comment .comment-body .control-icons .edit-icon").click(function(){
        var commentId = $(this).parent().siblings(".comment-id").val();
        var commentContent = $(this).parent().siblings(".content").text();
        $(this).parent().parent().hide(100,function(){
            $(this).siblings(".edit-comment-form").find(".comment-content").val(commentContent.toString());
            $(this).siblings(".edit-comment-form").find(".comment-id").val(commentId.toString());
            $(this).siblings(".edit-comment-form").show(100);
        });
    });
    // Edit Reply
    $(document).on('click',".replies .reply .reply-body .control-icons .edit-icon",function(){
    //$(".replies .reply .reply-body .control-icons .edit-icon").click(function(){
        var replyId = $(this).parent().siblings(".reply-id").val();
        var replyContent = $(this).parent().siblings(".content").text();
        $(this).parent().parent().hide(100,function(){
            $(this).siblings(".edit-reply-form").find(".reply-content").val(replyContent.toString());
            $(this).siblings(".edit-reply-form").find(".reply-id").val(replyId.toString());
            $(this).siblings(".edit-reply-form").show(100);
        });
    });
    // Like Live Click Effect
    $(".video-container .actions .make-action .like-this > a,.video-container-mobile .actions .make-action .like-this > a").click(function(){
        
        $("#react-sound").get(0).play();
        var likeImg = $(this).find("img");
        if(likeImg.hasClass("filter-darkgray")){
            likeImg.removeClass("filter-darkgray").addClass("filter-base");
        }else{
            likeImg.removeClass("filter-base").addClass("filter-darkgray");
        }
    });
    // Toggle input of comment
    $(".add-comment .toggle-input").click(function(){
       var inp = $(this).siblings(".content");
        if(inp.attr("type")=="text"){
            inp.attr("type","number").attr("placeholder","Add a price...");
            inp.attr("id","value");
            $(this).find("img").removeClass("filter-darkgray").addClass("filter-base");
        }else if(inp.attr("type")=="number"){
            inp.attr("type","text").attr("placeholder","Add a comment...");
            inp.attr("id","commint");
            $(this).find("img").removeClass("filter-base").addClass("filter-darkgray");
        }
    });
    // Edit Min Direct Value
    $(document).on('click',".informations-and-comments .comments-container .control-direct-value .edit-this",function(){
        var currentVal = $(this).siblings(".min-direct").text();
        $(this).siblings("form").find("input[type='text']").val(currentVal);
        $(this).siblings(".min-direct").slideToggle(100).siblings("form").slideToggle(100);
    });
    // Close Edit Min Direct Form
    $(".informations-and-comments .comments-container .control-direct-value > form .form-btn").click(function(){
        $(this).parent().siblings(".min-direct").slideToggle(100).siblings("form").slideToggle(100);
    });
    // Close Edit Comment Form
    $(document).on('click', ".edit-comment-form .form-btn", function() {
        $(this).parent().hide(300,function(){
            $(this).siblings(".comment-body").show();
        });
    });
    // Close Edit Comment Form If the key enter from keybord
    $(".edit-comment-form .comment-content").keypress(function (e) {
        if ((e.keyCode == 13) && (e.target.type != "textarea")) {
            $(this).parent().hide(300,function(){
                $(this).siblings(".comment-body").show();
            });

        }

    });
    // Close Edit Reply Form
    $(document).on('click', ".edit-reply-form .form-btn", function() {
        $(this).parent().hide(300,function(){
            $(this).siblings(".reply-body").show();
        });
    });
    // Close Edit Reply Form If the key enter from keybord
    $(".edit-reply-form .reply-content").keypress(function (e) {
        if ((e.keyCode == 13) && (e.target.type != "textarea")) {
            $(this).parent().hide(300,function(){
                $(this).siblings(".reply-body").show();
            });

        }

    });

    // Remove Comment When Deleted
   /* $(document).on('click', ".comment .comment-body .control-icons .delete-icon > img", function() {
        $(this).parents().eq(3).next().remove();
        $(this).parents().eq(3).remove();
    });*/
    // Remove Reply When Deleted
    /*$(document).on('click', ".replies .reply .reply-body .control-icons .delete-icon > img", function() {
        console.log("hi");
        $(this).parents().eq(3).remove();
    });*/
    var swiper = new Swiper('.swiper-container', {
      slidesPerView: 'auto',
      centeredSlides: false,
      spaceBetween: 30,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
    var swiper = new Swiper('.swiper-container-mobile', {
      slidesPerView: 'auto',
      centeredSlides: false,
      spaceBetween: 5,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });

    /** End Live Page **/
    /** Start Live Admin Page **/
    // Take timer values and submit form
    /*$(".informations-and-comments .time-container .timer-controls > button").click(function(e){
        e.preventDefault();
        var currentMinutes = $(this).parent().siblings(".minutes").text();
        var currentSeconds = $(this).parent().siblings(".seconds").text();
        var currentHours = $(this).parent().siblings(".hours").text();
        $(this).siblings(".minutes-inp").val(currentMinutes);
        $(this).siblings(".seconds-inp").val(currentSeconds);
        $(this).siblings(".hours-inp").val(currentHours);
        $(this).parent().submit();
    });*/
    // Show Edit Timer Form
    $(".informations-and-comments .time-container .edit-this").click(function(){
        var currentHours = $(this).siblings(".hours").text();
        var currentMinutes = $(this).siblings(".minutes").text();
        var currentSeconds = $(this).siblings(".seconds").text();
        $(this).siblings(".edit-timer").find(".hours").val(currentHours);
        $(this).siblings(".edit-timer").find(".minutes").val(currentMinutes);
        $(this).siblings(".edit-timer").find(".seconds").val(currentSeconds);
       $(this).siblings(".hours,.minutes,.separator,.seconds,.timer-controls").slideToggle(100).siblings(".edit-timer").slideToggle(100); 
    });
    // Close Edit Timer Form
    $(".informations-and-comments .time-container .edit-timer .form-btn").click(function(){
        $(this).parent().siblings(".hours,.minutes,.separator,.seconds,.timer-controls").slideToggle(100).siblings(".edit-timer").slideToggle(100);
    });
    // Change Timer
    $(".informations-and-comments .time-container .edit-timer .edit-seconds .plus-btn").click(function(e){
        e.preventDefault();
       var jump = $(this).parent().siblings(".jump").find("input").val();
        //console.log(jump);
        if(parseInt(jump) >= 60){
            var currentValMin = $(this).parent().parent().find(".edit-minutes").find("input").val();
            var currentValSec = $(this).siblings("input").val();
            var rest = parseInt(jump)-60;
            $(this).parent().parent().find(".edit-minutes").find("input").val(parseInt(currentValMin)+1);
             $(this).siblings("input").val(parseInt(currentValSec)+parseInt(rest));
        }else{
            var currentVal = $(this).siblings("input").val();
            $(this).siblings("input").val(parseInt(currentVal)+parseInt(jump));
        }
    });
    $(".informations-and-comments .time-container .edit-timer .edit-seconds .minus-btn").click(function(e){
        e.preventDefault();
       var jump = $(this).parent().siblings(".jump").find("input").val();
        //console.log(jump);
        if(parseInt(jump) >= 60){
            var currentValMin = $(this).parent().parent().find(".edit-minutes").find("input").val();
            var currentValSec = $(this).siblings("input").val();
            var rest = parseInt(jump)-60;
            $(this).parent().parent().find(".edit-minutes").find("input").val(parseInt(currentValMin)-1);
             $(this).siblings("input").val(parseInt(currentValSec)-parseInt(rest));
        }else{
            var currentVal = $(this).siblings("input").val();
            $(this).siblings("input").val(parseInt(currentVal)-parseInt(jump));
        }
    });
    $(".informations-and-comments .time-container .edit-timer .edit-minutes .plus-btn").click(function(e){
        e.preventDefault();
       var jump = $(this).parent().siblings(".jump").find("input").val();
       if(parseInt(jump) >= 60){
            var currentValHour = $(this).parent().parent().find(".edit-hours").find("input").val();
            var currentValMin = $(this).siblings("input").val();
            var rest = parseInt(jump)-60;
            $(this).parent().parent().find(".edit-hours").find("input").val(parseInt(currentValHour)+1);
             $(this).siblings("input").val(parseInt(currentValMin)+parseInt(rest));
        }else{
            var currentVal = $(this).siblings("input").val();
            $(this).siblings("input").val(parseInt(currentVal)+parseInt(jump));
        }
    });
    $(".informations-and-comments .time-container .edit-timer .edit-minutes .minus-btn").click(function(e){
        e.preventDefault();
       var jump = $(this).parent().siblings(".jump").find("input").val();
       if(parseInt(jump) >= 60){
            var currentValHour = $(this).parent().parent().find(".edit-hours").find("input").val();
            var currentValMin = $(this).siblings("input").val();
            var rest = parseInt(jump)-60;
            $(this).parent().parent().find(".edit-hours").find("input").val(parseInt(currentValHour)-1);
             $(this).siblings("input").val(parseInt(currentValMin)-parseInt(rest));
        }else{
            var currentVal = $(this).siblings("input").val();
            $(this).siblings("input").val(parseInt(currentVal)-parseInt(jump));
        }
    });
    $(".informations-and-comments .time-container .edit-timer .edit-hours .plus-btn").click(function(e){
        e.preventDefault();
       var jump = $(this).parent().siblings(".jump").find("input").val();
        //console.log(jump);
       var currentVal = $(this).siblings("input").val();
        $(this).siblings("input").val(parseInt(currentVal)+parseInt(jump));
    });
    $(".informations-and-comments .time-container .edit-timer .edit-hours .minus-btn").click(function(e){
        e.preventDefault();
       var jump = $(this).parent().siblings(".jump").find("input").val();
        //console.log(jump);
       var currentVal = $(this).siblings("input").val();
        $(this).siblings("input").val(parseInt(currentVal)-parseInt(jump));
    });
    // Show And Hide Edit Min Price
    $(".informations-and-comments .informations .prices .edit-this").click(function(){
        var currentMinPrice = $(this).siblings(".min").text();
        $(this).siblings(".edit-min-price").find(".min-price").val(currentMinPrice);
        $(this).siblings(".min").slideToggle(100).siblings(".edit-min-price").slideToggle(100); 
    });
    // Close Edit Min Price Form
    $(".informations-and-comments .informations .prices .edit-min-price .form-btn").click(function(){
        $(this).parent().siblings(".min").slideToggle(100).siblings(".edit-min-price").slideToggle(100);
    });
    // Show And Hide Edit Views
    $(".video-container .actions .views > div .edit-this").click(function(){
        var currentViews = $(this).siblings("span").text();
        $(this).siblings(".edit-views").find("input").val(currentViews);
        $(this).siblings(".view-icon,span").slideToggle(100).siblings(".edit-views").slideToggle(100); 
    });
    // Close Edit Views Form
    $(".video-container .actions .views .robot-views .edit-views .form-btn").click(function(){
        $(this).parent().siblings(".view-icon,span").slideToggle(100).siblings(".edit-views").slideToggle(100);
    });
    // Show And Hide Edit Likes
    $(".video-container .actions .make-action .like-this .edit-this").click(function(){
        var currentLikes = $(this).siblings(".robot-likes").text();
        $(this).siblings(".edit-likes").find("input").val(currentLikes);
        $(this).siblings(".robot-likes,.like-icon").slideToggle(100).siblings(".edit-likes").slideToggle(100);
    });
    // Close Edit Likes Form
    $(".video-container .actions .make-action .robot-likes .edit-likes .form-btn").click(function(){
        $(this).parent().siblings(".robot-likes,.like-icon").slideToggle(100).siblings(".edit-likes").slideToggle(100);
    });
    // Search For Comment Robot
    $(".video-container .comments-robots .header > input").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".video-container .comments-robots .comments-robots-container .comment-robot").filter(function() {
          $(this).toggle($(this).find(".card-body").find(".card-text").text().toLowerCase().indexOf(value) > -1)
        });
    });
    // Hide Start Live And Show End Live
    $(".start-live > a").click(function(){
       $(this).parent().hide(100,function(){
           $(".end-live").show(100);
       }); 
    });
    // Hide End Live And Show Start Live
    // $(".end-live > a").click(function(){
    //    $(this).parent().hide(100,function(){
    //        $(".start-live").show(100);
    //    }); 
    // });
    // Make Control Buttons Don't Reload Page
    $(".timer-controls > button,.audio-controls > button").click(function(e){
        e.preventDefault();
    });
    // Change the name of pause button control and the image
    $(".timer-controls .pause,.audio-controls .pause").click(function(){
        // var imgFullPath = $(this).find("img").attr("src");
        // var arr = imgFullPath.split('/',3);
        // var imgPath = arr[0]+'//'+arr[2];

        // //alert(imgPath);
        // if($(this).attr("name")=="pause"){
        //     $(this).attr("name","start").find("img").attr("src",imgPath+"/icons/play_arrow-24px.svg");
        //     //alert($(this).find("img").attr("src"));
        // }else if($(this).attr("name")=="start"){
        //     $(this).attr("name","pause").find("img").attr("src",imgPath+"/icons/pause-24px.svg");
        //     //alert($(this).find("img").attr("src"));
        // }

    });
    /** End Live Admin Page **/
    /** Start Welcome Page **/
    $(".audio-modal").modal('show');
 
    $(".audio-modal .modal-dialog .modal-content .modal-footer .allow").click(function(){
        $(".audio-modal").modal('hide');
        $("#player").get(0).play();
    });
    /** End Welcome Page **/
    

        //check audio status if its played so show modal to start it
        if($('#audio_status').val() == 1){
            $(".audio-modal-live").attr('name','start');
            $(".audio-modal-live").modal('show');
        }
            
    /*function deleteComment(){
        $(".comments").children("#remove").next().remove();
        $(".comments").children("#remove").remove();
    }*/
    /*$("body").click(function(){
       deleteComment();
    });*/
    
});
