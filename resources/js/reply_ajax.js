//
// REPLY AJAX FUNCTIONS
//

// TODO: Handle errors !!!!!!!

$(document).ready(function() {
    // upvote handler
    $(document).on('click', '.replyupvote', function(e){
        e.preventDefault();
        let href = $(this).attr('href');
        let hrefarray = href.split('/');
        let reply_id = hrefarray[hrefarray.length - 2];

        $.ajax({
            method: "GET",
            url: href,
            success: function(data, textStatus, XMLHTTPRequest){

                let sVotenumber = $('#reply-' + reply_id + '-votenumber');
                sVotenumber.text(data.vote);

                if(data.upvotedAlready){
                    $('#reply-' + reply_id + '-upvote').toggleClass('text-warning');
                    $('#reply-' + reply_id + '-votenumber').toggleClass('text-warning').toggleClass('text-light');
                } else if(data.downvotedAlready){
                    $('#reply-' + reply_id + '-upvote').toggleClass('text-warning');
                    $('#reply-' + reply_id + '-downvote').toggleClass('text-warning');
                } else {
                    $('#reply-' + reply_id + '-upvote').toggleClass('text-warning');
                    $('#reply-' + reply_id + '-votenumber').toggleClass('text-warning').toggleClass('text-light');
                }

            },
            error: function(XMLHTTPRequest, textStatus, errorThrown){
                alert('error');
            },
        });
    });
    // downvote handler
    $(document).on('click', '.replydownvote', function(e){
        e.preventDefault();
        let href = $(this).attr('href');
        let hrefarray = href.split('/');
        let reply_id = hrefarray[hrefarray.length - 2];

        $.ajax({
            method: "GET",
            url: href,
            success: function(data, textStatus, XMLHTTPRequest){

                let sVotenumber = $('#reply-' + reply_id + '-votenumber');
                sVotenumber.text(data.vote);

                if(data.downvotedAlready){
                    $('#reply-' + reply_id + '-downvote').toggleClass('text-warning');
                    $('#reply-' + reply_id + '-votenumber').toggleClass('text-warning').toggleClass('text-light');
                } else if(data.upvotedAlready){
                    $('#reply-' + reply_id + '-downvote').toggleClass('text-warning');
                    $('#reply-' + reply_id + '-upvote').toggleClass('text-warning');
                } else {
                    $('#reply-' + reply_id + '-downvote').toggleClass('text-warning');
                    $('#reply-' + reply_id + '-votenumber').toggleClass('text-warning').toggleClass('text-light');
                }

            },
            error: function(XMLHTTPRequest, textStatus, errorThrown){
                alert('error');
            },
        });
    });

});
