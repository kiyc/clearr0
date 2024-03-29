let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .stylus('resources/assets/stylus/vendor.styl', 'public/css')
    .extract([
    	'vue',
    	'vuex',
    	'vue-router',
        'vuetify',
        'vuetify/es5/util/colors',
        'axios',
        'lodash'
    ])
    .version()
