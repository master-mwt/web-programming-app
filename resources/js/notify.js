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

    let toast = `<div id="toast${toastId}" class="toast ml-auto bg-dark m-4" data-delay="${delay}" role="alert" aria-live="assertive" aria-atomic="true">
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

export {
    makeToast,
};
