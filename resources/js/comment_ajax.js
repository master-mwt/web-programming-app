//
// COMMENT AJAX FUNCTIONS
//

import {makeToast} from './notify';

let loginpath = window.location.protocol + "//" + window.location.host + "/login";

$(document).ready(function() {
    // delete handler
    $(document).on('click', '.commentdelete', function(e){
        e.preventDefault();
        let href = $(this).attr('href');
        let hrefarray = href.split('/');
        let comment_id = hrefarray[hrefarray.length - 1];

        if(href.trim() === loginpath){
            window.location.href = loginpath;
            return;
        }

        $.ajax({
            method: "DELETE",
            url: href,
            success: function(data, textStatus, XMLHTTPRequest){

                let comment = $('#comment-' + comment_id);
                comment.remove();

            },
            error: function(XMLHTTPRequest, textStatus, errorThrown){
                makeToast("Error", errorThrown, 4000);
            },
        });
    });

});
