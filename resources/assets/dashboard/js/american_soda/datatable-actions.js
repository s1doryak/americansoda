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
            $.showActionNotifications($.parseJSON(response.responseText), [])
        });

    });

    $(document).on('click', '[data-action="send"]', function (e) {

        var $this = $(this),
            $icon = $this.find('i.zmdi'),
            iconClass = $this.data('icon-class'),
            colorClass = $this.data('color-class'),
            progressIconClass = $this.data('progress-icon-class'),
            progressColorClass = $this.data('progress-color-class'),
            $row = $this.closest('tr'),
            $table = $this.closest('table'),
            dt = $table.DataTable();

        if ($table.hasClass('responsive') && $table.hasClass('collapsed')) {
            $row = $this.closest('tr').prev('[role="row"]');
        }

        $this.attr('disabled', true);
        $icon.removeClass(iconClass)
            .removeClass(colorClass)
            .addClass(progressIconClass)
            .addClass(progressColorClass);

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

            $this.attr('disabled', false);
            $icon.addClass(iconClass)
                .addClass(colorClass)
                .removeClass(progressIconClass)
                .removeClass(progressColorClass);

            switch (response.status) {
                case 200:
                case 204:
                    $this.replaceWith(response.responseText);
                    break;
                case 404:
                case 500:
                    notify(response.responseJSON.message, 'danger');
                    break;
            }

        });

        e.preventDefault();
    });

    $(document).on('click', '[data-action="send_email"]', function (e) {

        var $this = $(this),
            $icon = $this.find('i.zmdi'),
            iconClass = $this.data('icon-class'),
            colorClass = $this.data('color-class'),
            progressIconClass = $this.data('progress-icon-class'),
            progressColorClass = $this.data('progress-color-class'),
            $row = $this.closest('tr'),
            $table = $this.closest('table'),
            dt = $table.DataTable();

        if ($table.hasClass('responsive') && $table.hasClass('collapsed')) {
            $row = $this.closest('tr').prev('[role="row"]');
        }

        $this.attr('disabled', true);
        $icon.removeClass(iconClass)
            .removeClass(colorClass)
            .addClass(progressIconClass)
            .addClass(progressColorClass);

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

            $this.attr('disabled', false);
            $icon.addClass(iconClass)
                .addClass(colorClass)
                .removeClass(progressIconClass)
                .removeClass(progressColorClass);

            switch (response.status) {
                case 200:
                    $this.replaceWith(response.responseText);
                    break;
                case 404:
                case 500:
                    notify(response.responseJSON.message, 'danger');
                    break;
            }

        });

        e.preventDefault();
    });

    $(document).on('change', '[data-action="shipment_assign"]', function (e) {
        var $this = $(this),
            checked = $this.prop('checked'),
            $table = $this.closest('table'),
            dt = $table.DataTable();

        $this.prop('disabled', true);

        $.ajax({
            url: $this.data('url'),
            method: 'post',
            data: {
                _token: $this.data('token'),
                _method: $this.data('method'),
                need_shipping: checked
            },
            cache: false,
            async: true
        }).complete(function (response) {
            if (response.status === 200) {
                $this.prop('checked', checked);
                $this
                    .closest('tr[role=row]')
                    .find('.column-status span')
                    .replaceWith(response.responseText)
            } else {
                $this.prop('checked', !checked);
            }

            $this.prop('disabled', false);
        });

    });

    $(document).on('click', '[data-role="action"][data-action="ltpUpdate"]', function (e) {
        var $this = $(this),
            $icon = $this.find('i.zmdi'),
            iconClass = $this.data('icon-class'),
            colorClass = $this.data('color-class'),
            progressIconClass = $this.data('progress-icon-class'),
            progressColorClass = $this.data('progress-color-class');

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

            $this.attr('disabled', false);
            $icon.addClass(iconClass)
                .addClass(colorClass)
                .removeClass(progressIconClass)
                .removeClass(progressColorClass);

            switch (response.responseJSON.code) {
                case 200:
                    notify(response.responseJSON.message, 'success');
                    break;
                case 204:
                    notify(response.responseJSON.message, 'info');
                    break;
                case 500:
                    notify(response.responseJSON.message, 'danger');
                    break;
            }

        });

        e.preventDefault();
    });

    $(document).on('click', '[data-action="sendToLtp"]', function (e) {

        var $this = $(this),
            $icon = $this.find('i.zmdi'),
            iconClass = $this.data('icon-class'),
            colorClass = $this.data('color-class'),
            progressIconClass = $this.data('progress-icon-class'),
            progressColorClass = $this.data('progress-color-class'),
            $row = $this.closest('tr'),
            $table = $this.closest('table');

        $this.attr('disabled', true);
        $icon.removeClass(iconClass)
            .removeClass(colorClass)
            .addClass(progressIconClass)
            .addClass(progressColorClass);

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

            $this.attr('disabled', false);
            $icon.addClass(iconClass)
                .addClass(colorClass)
                .removeClass(progressIconClass)
                .removeClass(progressColorClass);

            switch (response.status) {
                case 200:
                case 204:
                    $this.replaceWith(response.responseJSON.message);
                    break;
                case 404:
                case 403:
                case 500:
                    notify(response.responseJSON.message, 'danger');
                    break;
            }

        });

        e.preventDefault();
    });
});

