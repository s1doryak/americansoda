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

const path = {
        bower: '../../../bower_components',
        app: 'resources/assets/app',
        dashboard: 'resources/assets/dashboard'
    },
    css = {
        app: path.app + '/less/app.less',
        dashboard: path.dashboard + '/less/dashboard.less'
    },
    js = {
        app: [],
        dashboard: [

            /**
             * American Soda
             */
            path.dashboard + '/js/american_soda/datatable-actions.js',
            path.dashboard + '/js/american_soda/relation-form.js',
            path.dashboard + '/js/american_soda/supplier-order-form.js',
            path.dashboard + '/js/american_soda/customer-order-form.js',
            path.dashboard + '/js/american_soda/customer-order-item-split-form.js',
            path.dashboard + '/js/american_soda/stock-movement-form.js',

            /**
             * Dashboard
             */
            path.dashboard + '/js/dashboard.js',
        ],
    },
    i18n = {
        ru: [
            path.bower + '/moment/locale/ru.js',
            path.bower + '/fullcalendar/dist/locale/ru.js',
            path.bower + '/summernote/dist/lang/summernote-ru-RU.js',
            path.bower + '/bootstrap-select/dist/js/i18n/defaults-ru_RU.js',
            path.bower + '/ajax-bootstrap-select/dist/js/locale/ajax-bootstrap-select.ru-RU.js'
        ],
        en: [
            path.bower + '/bootstrap-select/dist/js/i18n/defaults-en_US.js',
            path.bower + '/ajax-bootstrap-select/dist/js/locale/ajax-bootstrap-select.en-US.js'
        ],
        fi: [
            path.bower + '/moment/locale/fi.js',
            path.bower + '/fullcalendar/dist/locale/fi.js',
            path.bower + '/summernote/dist/lang/summernote-fi-FI.js',
            path.bower + '/bootstrap-select/dist/js/i18n/defaults-fi_FI.js',
            path.bower + '/ajax-bootstrap-select/dist/js/locale/ajax-bootstrap-select.en-US.js'
        ],
        et: [
            path.bower + '/moment/locale/et.js',
            path.bower + '/bootstrap-select/dist/js/i18n/defaults-et_EE.js',
            path.bower + '/ajax-bootstrap-select/dist/js/locale/ajax-bootstrap-select.en-US.js'
        ]

    };

/**
 * Vendor fonts better organizing
 */
// mix.copy('resources/assets/app/fonts', 'public/build/fonts');
mix.copy('resources/assets/dashboard/fonts', 'public/dashboard/fonts');

/**
 * Images
 */
// mix.copy('resources/assets/app/img', 'public/build/img/app');
mix.copy('resources/assets/dashboard/img', 'public/dashboard/img');

/**
 * Styles
 */
// mix.less(css.app);
mix.less(css.dashboard, 'public/dashboard/css/dashboard.css');

/**
 * Scripts
 */
// mix.scripts(js.app, 'public/js/dashboard/app.js');
mix.scripts(js.dashboard, 'public/dashboard/js/dashboard.js');
