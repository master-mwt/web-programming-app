//
// POST AJAX FUNCTIONS
//

let loginpath = window.location.protocol + "//" + window.location.host + "/login";

// TODO: Handle errors !!!!!!!

$(document).ready(function() {
    // upvote handler
    $(document).on('click', '.upvote', function(e){
        e.preventDefault();
        let href = $(this).attr('href');
        let hrefarray = href.split('/');
        let post_id = hrefarray[hrefarray.length - 2];

        $.ajax({
            method: "GET",
            url: href,
            success: function(data, textStatus, XMLHTTPRequest){

                let sVotenumber = $('#post-' + post_id + '-votenumber');
                sVotenumber.text(data.vote);

                if(data.upvotedAlready){
                    $('#post-' + post_id + '-upvote').toggleClass('text-warning');
                    $('#post-' + post_id + '-votenumber').toggleClass('text-warning').toggleClass('text-light');
                } else if(data.downvotedAlready){
                    $('#post-' + post_id + '-upvote').toggleClass('text-warning');
                    $('#post-' + post_id + '-downvote').toggleClass('text-warning');
                } else {
                    $('#post-' + post_id + '-upvote').toggleClass('text-warning');
                    $('#post-' + post_id + '-votenumber').toggleClass('text-warning').toggleClass('text-light');
                }

            },
            error: function(XMLHTTPRequest, textStatus, errorThrown){
                alert('error');
            },
        });
    });
    // downvote handler
    $(document).on('click', '.downvote', function(e){
        e.preventDefault();
        let href = $(this).attr('href');
        let hrefarray = href.split('/');
        let post_id = hrefarray[hrefarray.length - 2];

        $.ajax({
            method: "GET",
            url: href,
            success: function(data, textStatus, XMLHTTPRequest){

                let sVotenumber = $('#post-' + post_id + '-votenumber');
                sVotenumber.text(data.vote);

                if(data.downvotedAlready){
                    $('#post-' + post_id + '-downvote').toggleClass('text-warning');
                    $('#post-' + post_id + '-votenumber').toggleClass('text-warning').toggleClass('text-light');
                } else if(data.upvotedAlready){
                    $('#post-' + post_id + '-downvote').toggleClass('text-warning');
                    $('#post-' + post_id + '-upvote').toggleClass('text-warning');
                } else {
                    $('#post-' + post_id + '-downvote').toggleClass('text-warning');
                    $('#post-' + post_id + '-votenumber').toggleClass('text-warning').toggleClass('text-light');
                }

            },
            error: function(XMLHTTPRequest, textStatus, errorThrown){
                alert('error');
            },
        });
    });
    // save handler
    $(document).on('click', '.save', function(e){
        e.preventDefault();
        let href = $(this).attr('href');
        let hrefarray = href.split('/');
        let post_id = hrefarray[hrefarray.length - 2];

        if(href.trim() === loginpath){
            window.location.href = loginpath;
            return;
        }

        $.ajax({
            method: "GET",
            url: href,
            success: function(data, textStatus, XMLHTTPRequest){

                let sSavePost = $('#post-' + post_id + '-save');

                sSavePost.toggleClass('text-danger');
                $('#post-' + post_id + '-save-icon').toggleClass('far').toggleClass('fas');

                let saveText = sSavePost.text();
                let children = sSavePost.children();
                sSavePost.text( saveText === 'Save' ? 'Unsave' : 'Save' );
                sSavePost.prepend(children);

            },
            error: function(XMLHTTPRequest, textStatus, errorThrown){
                alert('error');
            },
        });
    });
    // hide handler
    $(document).on('click', '.hide', function(e){
        e.preventDefault();
        let href = $(this).attr('href');
        let hrefarray = href.split('/');
        let post_id = hrefarray[hrefarray.length - 2];

        if(href.trim() === loginpath){
            window.location.href = loginpath;
            return;
        }

        $.ajax({
            method: "GET",
            url: href,
            success: function(data, textStatus, XMLHTTPRequest){

                let sHidePost = $('#post-' + post_id + '-hide');

                sHidePost.toggleClass('text-danger');
                $('#post-' + post_id + '-hide-icon').toggleClass('far').toggleClass('fas');

                let hideText = sHidePost.text();
                let children = sHidePost.children();
                sHidePost.text( hideText === 'Hide' ? 'Unhide' : 'Hide' );
                sHidePost.prepend(children);

            },
            error: function(XMLHTTPRequest, textStatus, errorThrown){
                alert('error');
            },
        });
    });
    // report handler
    $(document).on('click', '.report', function(e){
        e.preventDefault();
        let href = $(this).attr('href');
        let hrefarray = href.split('/');
        let post_id = hrefarray[hrefarray.length - 2];

        if(href.trim() === loginpath){
            window.location.href = loginpath;
            return;
        }

        $.ajax({
            method: "GET",
            url: href,
            success: function(data, textStatus, XMLHTTPRequest){

                let sReportPost = $('#post-' + post_id + '-report');

                sReportPost.toggleClass('text-danger');
                $('#post-' + post_id + '-report-icon').toggleClass('far').toggleClass('fas');

                let reportText = sReportPost.text();
                let children = sReportPost.children();
                sReportPost.text( reportText === 'Report' ? 'Unreport' : 'Report' );
                sReportPost.prepend(children);

            },
            error: function(XMLHTTPRequest, textStatus, errorThrown){
                alert('error');
            },
        });
    });

});
