const mix = require('laravel-mix');
const glob = require('glob-all');
require('laravel-mix-purgecss');

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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .purgeCss({
        folders: ['resources', 'modules'],

        whitelistPatterns: [
            /Layer_1/,
            /st1/
        ],
    })
   .options({
        processCssUrls: false
    })
   .version();
