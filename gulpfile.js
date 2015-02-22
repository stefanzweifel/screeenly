var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

    /**
     * Merge Javascript together
     */
    mix.scripts([
        'vendor/particles.js/particles.js',
        'assets/js/ga.js',
        'assets/js/main.js'
    ], 'public/assets/app.js', 'resources/');

    /**
     * Compile Sass
     */
    mix.sass('main.scss', 'public/assets');

});
