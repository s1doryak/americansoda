(function ($, DataTable) {
    "use strict";

    $.extend(true, DataTable.Buttons.defaults, {
        dom: {
            container: {
                className: 'dt-buttons'
            },
            button: {
                className: 'btn btn-link btn-sm'
            }
        }
    });

    DataTable.util.buildParams = function (dt, action) {
        var params = dt.ajax.params();
        params.action = action;
        params._token = $('meta[name="csrf-token"]').attr('content');

        return params;
    };

    DataTable.util.buildUrl = function (dt, action) {
        var url = dt.ajax.url() || window.location.href;
        var params = dt.ajax.params();
        params.action = action;

        if (url.indexOf('?') > -1) {
            return url + '&' + $.param(params);
        }

        return url + '?' + $.param(params);
    };

    DataTable.util.processAction = function (dt, action) {
        window.location = DataTable.util.buildUrl(dt, action);
    };

    DataTable.util.downloadFromUrl = function (url, params) {
        var postUrl = url + '/export';
        var xhr = new XMLHttpRequest();
        xhr.open('POST', postUrl, true);
        xhr.responseType = 'arraybuffer';
        xhr.onload = function () {
            if (this.status === 200) {
                var filename = '';
                var disposition = xhr.getResponseHeader('Content-Disposition');
                if (disposition && disposition.indexOf('attachment') !== -1) {
                    var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                    var matches = filenameRegex.exec(disposition);
                    if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                }
                var type = xhr.getResponseHeader('Content-Type');

                var blob = new Blob([this.response], {type: type});
                if (typeof window.navigator.msSaveBlob !== 'undefined') {
                    // IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                    window.navigator.msSaveBlob(blob, filename);
                } else {
                    var URL = window.URL || window.webkitURL;
                    var downloadUrl = URL.createObjectURL(blob);

                    if (filename) {
                        // use HTML5 a[download] attribute to specify filename
                        var a = document.createElement('a');
                        // safari doesn't support this yet
                        if (typeof a.download === 'undefined') {
                            window.location = downloadUrl;
                        } else {
                            a.href = downloadUrl;
                            a.download = filename;
                            document.body.appendChild(a);
                            a.click();
                        }
                    } else {
                        window.location = downloadUrl;
                    }

                    setTimeout(function () {
                        URL.revokeObjectURL(downloadUrl);
                    }, 100); // cleanup
                }
            }
        };
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send($.param(params));
    };

    DataTable.ext.buttons.excel = {
        className: 'buttons-excel',

        text: function (dt) {
            return '<i class="fa fa-file-excel-o"></i> ' + dt.i18n('buttons.excel', 'Excel');
        },

        action: function (e, dt, button, config) {
            DataTable.util.processAction(dt, 'excel');
        }
    };

    DataTable.ext.buttons.postExcel = {
        className: 'buttons-excel',

        text: function (dt) {
            return '<i class="fa fa-file-excel-o"></i> ' + dt.i18n('buttons.excel', 'Excel');
        },

        action: function (e, dt, button, config) {
            var url = dt.ajax.url() || window.location.href;
            var params = DataTable.util.buildParams(dt, 'excel');

            DataTable.util.downloadFromUrl(url, params);
        }
    };

    DataTable.ext.buttons.export = {
        extend: 'collection',

        className: 'buttons-export',

        text: function (dt) {
            return '<i class="fa fa-download"></i> ' + dt.i18n('buttons.export', 'Export') + '&nbsp;<span class="caret"/>';
        },

        buttons: ['csv', 'excel', 'pdf']
    };

    DataTable.ext.buttons.csv = {
        className: 'buttons-csv',

        text: function (dt) {
            return '<i class="fa fa-file-excel-o"></i> ' + dt.i18n('buttons.csv', 'CSV');
        },

        action: function (e, dt, button, config) {
            DataTable.util.processAction(dt, 'csv');
        }
    };

    DataTable.ext.buttons.postCsv = {
        className: 'buttons-csv',

        text: function (dt) {
            return '<i class="fa fa-file-excel-o"></i> ' + dt.i18n('buttons.csv', 'CSV');
        },

        action: function (e, dt, button, config) {
            var url = dt.ajax.url() || window.location.href;
            var params = DataTable.util.buildParams(dt, 'csv');

            DataTable.util.downloadFromUrl(url, params);
        }
    };

    DataTable.ext.buttons.pdf = {
        className: 'buttons-pdf',

        text: function (dt) {
            return '<i class="fa fa-file-pdf-o"></i> ' + dt.i18n('buttons.pdf', 'PDF');
        },

        action: function (e, dt, button, config) {
            DataTable.util.processAction(dt, 'pdf');
        }
    };

    DataTable.ext.buttons.postPdf = {
        className: 'buttons-pdf',

        text: function (dt) {
            return '<i class="fa fa-file-pdf-o"></i> ' + dt.i18n('buttons.pdf', 'PDF');
        },

        action: function (e, dt, button, config) {
            var url = dt.ajax.url() || window.location.href;
            var params = DataTable.util.buildParams(dt, 'pdf');

            DataTable.util.downloadFromUrl(url, params);
        }
    };

    DataTable.ext.buttons.print = {
        className: 'buttons-print',

        text: function (dt) {
            return '<i class="fa fa-print"></i> ' + dt.i18n('buttons.print', 'Print');
        },

        action: function (e, dt, button, config) {
            DataTable.util.processAction(dt, 'print');
        }
    };

    DataTable.ext.buttons.reset = {
        className: 'buttons-reset',

        text: function (dt) {
            return '<i class="fa fa-undo"></i> ' + dt.i18n('buttons.reset', 'Reset');
        },

        action: function (e, dt, button, config) {
            dt.search('').draw();
        }
    };

    DataTable.ext.buttons.reload = {
        className: 'buttons-reload',

        text: function (dt) {
            return '<i class="fa fa-refresh"></i> ' + dt.i18n('buttons.reload', 'Reload');
        },

        action: function (e, dt, button, config) {
            dt.draw(false);
        }
    };

    DataTable.ext.buttons.create = {
        className: 'buttons-create',

        text: function (dt) {
            return '<i class="fa fa-plus"></i> ' + dt.i18n('buttons.create', 'Create');
        },

        action: function (e, dt, button, config) {
            window.location = window.location.href.replace(/\/+$/, '') + '/create';
        }
    };

    DataTable.ext.buttons.index = {
        className: 'buttons-index',

        text: function (dt) {
            return '<i class="fa fa-list"></i> ' + dt.i18n('buttons.trashed', 'Index');
        },

        action: function (e, dt, button, config) {
            window.location = config.url || window.location.href.replace(/\/+$/, '') + '/';
        }
    };

    DataTable.ext.buttons.trashed = {
        className: 'buttons-trashed',

        text: function (dt) {
            return '<i class="fa fa-trash"></i> ' + dt.i18n('buttons.trashed', 'Trashed');
        },

        action: function (e, dt, button, config) {
            window.location = config.url || window.location.href.replace(/\/+$/, '') + '/trashed';
        }
    };

    DataTable.ext.buttons.filter = {
        className: 'buttons-filter',

        text: function (dt) {
            return '<i class="fa fa-filter"></i> ' + dt.i18n('buttons.filter', 'Filter');
        },

        action: function (e, dt, button, config) {
            var tableId = dt.table().node().id,
                filterId = tableId + 'Filter';

            if (window.jQuery) {
                jQuery('#' + filterId).slideToggle();
            } else {
                var filter = document.getElementById(filterId);
                filter.style.display = filter.style.display === 'none' ? '' : 'none';
            }
        }
    };

    DataTable.ext.buttons.action = {
        className: 'buttons-action',

        attr: {
            "data-role": 'action',
            "data-acton": 'action',
            "data-resource": '',
            "data-url": window.location.href.replace(/\/+$/, '') + '/',
            "data-method": 'GET',
            "data-token": $('meta[name="csrf-token"]').attr('content')
        },

        text: function (dt) {
            return '<i class="fa fa-star"></i> ' + dt.i18n('buttons.action', 'Action');
        },

        action: function (e, dt, button, config) {
            e.preventDefault();
        }
    };

    DataTable.ext.buttons.link = {
        className: 'buttons-link',

        text: function (dt) {
            return '<i class="fa fa-link"></i> ' + dt.i18n('buttons.action', 'Go');
        },

        action: function (e, dt, button, config) {
            window.location = config.url || window.location.href.replace(/\/+$/, '') + '/';
        }
    };

})(jQuery, jQuery.fn.dataTable);
