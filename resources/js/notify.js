// UTILS: NOTIFY

/**
 * A stacking toast generation
 *
 * @param {string} title The title of the toast
 * @param {string} body The body of the toast
 * @param {number} delay The delay of the toast (in milliseconds)
 */
let toastId = 0;
function makeToast(title, body, delay){
    let now = new Date();
    let time = now.getHours() + ':' + now.getMinutes();

    let toast = `<div id="toast${toastId}" class="toast ml-auto bg-primary m-4" data-delay="${delay}" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <strong class="mr-auto">${title}</strong>
                        <small class="text-muted">${time}</small>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">${body}</div>
                 </div>`;

    $('#toast-container').append(toast);
    $(document).find('#toast' + toastId).toast('show');
    toastId++;
}


/**
 * Notifications handling
 */
let notifications = [];
let postpath = window.location.protocol + "//" + window.location.host + "/discover/post/";

$(document).ready(function() {
    if(window.userIsLogged){
        notification();
        setInterval(notification, 10000);
    }
});

function notification(){
    $.get('/notifications', function (data) {
        addNotifications(data);
    });
}

function addNotifications(newNotifications) {

    if(newNotifications.length === notifications.length){
        return;
    }

    notifications = newNotifications;
    $('#notification-area').empty();
    $('#notification-count').text(notifications.length + ' Notifications');

    if(notifications.length){
        $('#notification-button').addClass('text-danger');
    } else {
        $('#notification-button').removeClass('text-danger');
    }

    notifications.forEach(function(entry) {
        let notification = `<a href="${postpath + entry.data.post_id}?readnotification=${entry.id}" class="my-2">
                                <i class="fas fa-users mr-2"></i> ${entry.data.data}
                                <span class="float-right text-muted text-sm">${entry.created_at}</span>
                            </a>`;
        $('#notification-area').append(notification);
    });

    makeToast('Notification', 'You have new notifications', 4000);
}

export {
    makeToast,
};
