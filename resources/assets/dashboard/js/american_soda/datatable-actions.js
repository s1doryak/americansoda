jQuery(document).ready(function ($) {

    $(document).on('change', '[data-action="maventa_paid"]', function (e) {
        var $this = $(this),
            checked = $this.prop('checked'),
            $table = $this.closest('table'),
            dt = $table.DataTable();

        $.ajax({
            url: $this.data('url'),
            method: 'post',
            data: {
                _token: $this.data('token'),
                _method: $this.data('method')
            },
            cache: false,
            async: true
        }).complete(function (response) {

            if (response.status === 200) {
                $this.prop('checked', checked);
                $this.prop('disabled', true);
                dt.draw(false);
            } else {
                $this.prop('checked', !checked);
                $this.prop('disabled', false);
            }

        });

    });

    $(document).on('click', '[data-action="send_email"]', function (e) {

        var progressIconClass = 'zmdi-hourglass-alt';
        var actionIconSelector = 'i.zmdi';

        var $this = $(this),
            $icon = $this.find(actionIconSelector),
            iconClass = 'zmdi-email';

        $this.prop('disabled', true);
        $icon.removeClass(iconClass).addClass(progressIconClass);

        $.ajax({
            url: $this.data('url'),
            method: 'post',
            data: {
                _token: $this.data('token'),
                _method: 'post'
            },
            cache: false,
            async: true
        }).complete(function (response) {

            if (response.status === 200) {
                $this.replaceWith(response.responseText);
            } else {
                $this.prop('disabled', false);
                $icon.addClass(iconClass).removeClass(progressIconClass);
            }

        });

        e.preventDefault();
    });

    $(document).on('change', '[data-action="shipment_assign"]', function (e) {
        var $this = $(this),
            checked = $this.prop('checked');

        $this.prop('disabled', true);

        $.ajax({
            url: $this.data('url'),
            method: 'post',
            data: {
                _token: $this.data('token'),
                _method: 'post',
                need_shipping: checked
            },
            cache: false,
            async: true
        }).complete(function (response) {

            if (response.status === 200) {
                $this.prop('checked', checked);
            } else {
                $this.prop('checked', !checked);
            }

            $this.prop('disabled', false);
        });

    });
});

