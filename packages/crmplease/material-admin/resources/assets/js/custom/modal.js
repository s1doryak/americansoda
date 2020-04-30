jQuery(document).ready(function ($) {

    var modals = [];

    $(document).on('shown.bs.modal', function (e) {
        if (modals.indexOf(e.target) === -1) {
            modals.push(e.target);
        }
    });

    $(document).on('hidden.bs.modal', function (e) {
        if (modals.indexOf(e.target) === -1) {
            modals.splice(modals.indexOf(e.target), 1);
        }

        if (modals.length > 0) {
            $('body').addClass('modal-open');
        } else {
            $('body').removeClass('modal-open');
        }
    });

});