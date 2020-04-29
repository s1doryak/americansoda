function notify(message, type) {
    jQuery.notify({
        message: message
    }, {
        type: type || 'info',
        allow_dismiss: true,
        newest_on_top: true,
        placement: {
            from: 'top',
            align: 'center'
        },
        offset: $.notificationOffset,
        delay: $.notificationDelay,
        z_index: $.notificationZIndex
    });
}

jQuery(function ($) {

    /**
     * This adds padding in pixels between the element and the notification creating a space between their edges.
     * @see http://bootstrap-notify.remabledesigns.com/
     * @type {number}
     */
    $.notificationOffset = {
        x: 0,
        y: 20
    };

    /**
     * If delay is set higher than 0 then the notification will auto-close after the delay period is up.
     * Please keep in mind that delay uses milliseconds so 5000 is 5 seconds.
     * @see http://bootstrap-notify.remabledesigns.com/
     * @type {number}
     */
    $.notificationDelay = 3000;

    /**
     * Pretty simple, this sets the css property z-index for the notification.
     * You may have to raise this number if you have other elements overlapping the notification.
     * @see http://bootstrap-notify.remabledesigns.com/
     * @type {number}
     */
    $.notificationZIndex = 1060;

    /**
     * Process pre-loaded notifications.
     */
    $('[data-role="notification"]').each(function () {
        var $notification = $(this);

        notify($notification.data('message') || $notification.html(), $notification.data('type'));
    });
});
