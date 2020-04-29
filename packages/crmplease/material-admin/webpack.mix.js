const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

const less = {
        processCssUrls: false,
        relativeUrls: false
    },
    path = {
        node: 'node_modules',
        ma: 'resources/assets',
    },
    css = {
        ma: path.ma + '/less/material-admin.less',
        demo: path.ma + '/less/demo.less',
        charts: path.ma + '/less/charts.less',
        datatables: path.ma + '/less/datatables.less',
        fullcalendar: path.ma + '/less/fullcalendar.less',
    },
    js = {
        ma: [

            /**
             * Vendor
             */
            path.node + '/jquery/dist/jquery.min.js',
            path.node + '/moment/min/moment.min.js',
            path.node + '/bootstrap/dist/js/bootstrap.min.js',
            path.node + '/bootstrap-notify/bootstrap-notify.min.js',
            path.node + '/bootstrap-select/dist/js/bootstrap-select.js',
            path.node + '/bootstrap-daterangepicker/daterangepicker.js',
            path.node + '/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js',
            path.node + '/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
            path.node + '/lightgallery/dist/js/lightgallery.min.js',
            path.node + '/jquery-mask-plugin/dist/jquery.mask.min.js',
            path.node + '/jquery-serializeobject/jquery.serializeObject.js',
            path.node + '/dropzone/dist/min/dropzone.min.js',
            path.node + '/trumbowyg/dist/trumbowyg.min.js',
            path.node + '/trumbowyg/dist/plugins/pasteimage/trumbowyg.pasteimage.min.js',

            /**
             * Material Admin
             */
            path.ma + '/js/inc/functions.js',
            path.ma + '/js/inc/actions.js',
            path.ma + '/js/custom/actions.js',
            path.ma + '/js/custom/change-skin.js',
            path.ma + '/js/custom/functions.js',
            path.ma + '/js/custom/form.js',
            path.ma + '/js/custom/modal.js',
            path.ma + '/js/custom/notifications.js',
            path.ma + '/js/custom/trumbowyg/trumbowyg.js',
            path.ma + '/js/material-admin.js'
        ],
        charts: [

            /**
             * jQuery Charts
             */
            path.node + '/jquery-sparkline/jquery.sparkline.min.js',
            path.node + '/easy-pie-chart/dist/jquery.easypiechart.min.js',

            /**
             * Flot.js
             */
            path.node + '/flot/jquery.flot.js',
            path.node + '/flot/jquery.flot.resize.js',
            path.node + '/flot/jquery.flot.crosshair.js',
            path.node + '/flot/jquery.flot.fillbetween.js',
            path.node + '/flot/jquery.flot.time.js',
            path.node + '/flot/jquery.flot.canvas.js',
            path.node + '/flot/jquery.flot.navigate.js',
            path.node + '/flot.curvedlines/curvedLines.js',
            path.node + '/jquery.flot.tooltip/js/jquery.flot.tooltip.min.js',

            /**
             * D3.js
             */
            path.node + '/d3/dist/d3.min.js',

            /**
             * C3.js
             */
            path.node + '/c3/c3.min.js',
        ],
        datatables: [

            /**
             * Datatables
             */
            path.node + '/datatables.net/js/jquery.dataTables.min.js',
            path.node + '/datatables.net-buttons/js/dataTables.buttons.min.js',
            path.node + '/datatables.net-buttons/js/buttons.colVis.min.js',
            path.node + '/datatables.net-buttons-bs/js/buttons.bootstrap.min.js',
            path.node + '/datatables.net-fixedcolumns/js/dataTables.fixedColumns.min.js',
            path.node + '/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js',
            path.node + '/datatables.net-keytable/js/dataTables.keyTable.min.js',
            path.node + '/datatables.net-responsive/js/dataTables.responsive.min.js',
            path.node + '/datatables.net-responsive-bs/js/responsive.bootstrap.min.js',
            path.node + '/datatables.net-select/js/dataTables.select.min.js',

            /**
             * DataTables Custom
             */
            path.ma + '/js/custom/datatables/buttons.server-side.js',
            path.ma + '/js/custom/datatables/events.js',
        ],
        fullcalendar: [

            /**
             * FullCalendar
             */
            path.node + '/@fullcalendar/core/main.js',
            path.node + '/@fullcalendar/moment/main.js',
            path.node + '/@fullcalendar/moment-timezone/main.js',
            path.node + '/@fullcalendar/interaction/main.js',
            path.node + '/@fullcalendar/daygrid/main.js',
            path.node + '/@fullcalendar/list/main.js',
            path.node + '/@fullcalendar/timeline/main.js',
            path.node + '/@fullcalendar/timegrid/main.js',
            path.node + '/@fullcalendar/resource-common/main.js',
            path.node + '/@fullcalendar/resource-daygrid/main.js',
            path.node + '/@fullcalendar/resource-timegrid/main.js',
            path.node + '/@fullcalendar/resource-timeline/main.js',
        ],
        demo: [

            /**
             * Demo
             */
            path.ma + '/js/demo.js'
        ],
    },
    i18n = {
        ru: [
            path.node + '/@fullcalendar/core/locales/ru.js',
            path.node + '/bootstrap-select/dist/js/i18n/defaults-ru_RU.js',
            path.node + '/moment/locale/ru.js',
            path.node + '/trumbowyg/dist/langs/ru.min.js',
        ],
        en: [
            path.node + '/bootstrap-select/dist/js/i18n/defaults-en_US.min.js',
            path.node + '/moment/locale/en-gb.js',
        ],
        fi: [
            path.node + '/@fullcalendar/core/locales/fi.js',
            path.node + '/bootstrap-select/dist/js/i18n/defaults-fi_FI.min.js',
            path.node + '/moment/locale/fi.js',
            path.node + '/trumbowyg/dist/langs/ru.min.js',
        ],
        et: [
            path.node + '/@fullcalendar/core/locales/et.js',
            path.node + '/bootstrap-select/dist/js/i18n/defaults-et_EE.min.js',
            path.node + '/moment/locale/et.js',
        ]

    };

/*
|--------------------------------------------------------------------------
| Material Admin
|--------------------------------------------------------------------------
*/
mix.copy('resources/assets/fonts', 'public/fonts');
mix.copy('node_modules/material-design-iconic-font/dist/fonts', 'public/fonts/material-design-iconic-font/');
mix.copy('node_modules/bootstrap/fonts/', 'public/fonts/glyphicons-halflings/');
mix.copy('node_modules/font-awesome/fonts/', 'public/fonts/font-awesome/');
mix.copy('node_modules/lightgallery/src/fonts/', 'public/fonts/lg/');
mix.copy('resources/assets/img', 'public/img/');
mix.less(css.ma, 'public/css/material-admin.css').options(less);
mix.scripts(js.ma, 'public/js/material-admin.js');

/*
|--------------------------------------------------------------------------
| Charts (jQuery + Flot.js + D3.js + C3.js)
|--------------------------------------------------------------------------
*/
mix.less(css.charts, 'public/css/charts.css').options(less);
mix.scripts(js.charts, 'public/js/charts.js');

/*
|--------------------------------------------------------------------------
| DataTables
|--------------------------------------------------------------------------
*/
mix.less(css.datatables, 'public/css/datatables.css').options(less);
mix.scripts(js.datatables, 'public/js/datatables.js');

/*
|--------------------------------------------------------------------------
| FullCalendar
|--------------------------------------------------------------------------
*/
mix.less(css.fullcalendar, 'public/css/fullcalendar.css').options(less);
mix.scripts(js.fullcalendar, 'public/js/fullcalendar.js');

/*
|--------------------------------------------------------------------------
| Demo
|--------------------------------------------------------------------------
*/
mix.less(css.demo, 'public/css/demo.css').options(less);
mix.scripts(js.demo, 'public/js/demo.js');

/*
|--------------------------------------------------------------------------
| i18n
|--------------------------------------------------------------------------
*/
mix.scripts(i18n.en, 'public/js/material-admin-en.js');
mix.scripts(i18n.ru, 'public/js/material-admin-ru.js');
mix.scripts(i18n.fi, 'public/js/material-admin-fi.js');
mix.scripts(i18n.et, 'public/js/material-admin-et.js');
