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
        node: 'node_modules',
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
             * Vendor
             */
            path.node + '/handlebars/dist/handlebars.min.js',

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
    };

/**
 * Vendor fonts better organizing
 */
// mix.copy('resources/assets/app/fonts', 'public/build/fonts');
mix.copy('resources/assets/dashboard/fonts', 'public/assets/dashboard/fonts');

/**
 * Images
 */
// mix.copy('resources/assets/app/img', 'public/build/img/app');
mix.copy('resources/assets/dashboard/img', 'public/assets/dashboard/img');

/**
 * Styles
 */
// mix.less(css.app);
mix.less(css.dashboard, 'public/assets/dashboard/css/dashboard.css');

/**
 * Scripts
 */
// mix.scripts(js.app, 'public/js/dashboard/app.js');
mix.scripts(js.dashboard, 'public/assets/dashboard/js/dashboard.js');
