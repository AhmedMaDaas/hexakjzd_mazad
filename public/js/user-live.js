$(document).ready(function(){
    
    // Make a function to scroll to the last comment
    function scrollLastCommentMobile() {
        if($('.video-container-mobile .comments-container .comments').children(".comment").length > 0){
            $('.video-container-mobile .comments-container .comments').animate({ 
            scrollTop: $(".video-container-mobile .comments-container .comments .comment:last").position().top
            
            }, 500);
        }
    }
    function scrollLastComment() {
        if($('.informations-and-comments .comments-container .comments').children(".comment").length > 0){
            $('.informations-and-comments .comments-container .comments').animate({ 
            scrollTop: $(".informations-and-comments .comments-container .comments .comment:last").position().top
            
            }, 500);
        }
    }
    // Call the scroll to last comment function for the first time
    scrollLastCommentMobile();
    scrollLastComment();
});