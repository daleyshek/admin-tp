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


mix.js('resources/js/admin_common.js', 'public/assets/js')
   .sass('resources/sass/admin_common.scss', 'public/assets/css')
   .styles(['node_modules/admin-lte/dist/css/AdminLTE.css', 'node_modules/admin-lte/dist/css/skins/_all-skins.css'],
   'public/assets/css/admin-lte.css');

mix.js('resources/js/site.js', 'public/assets/js')
    .sass('resources/sass/site.scss', 'public/assets/css');