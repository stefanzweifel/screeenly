var elixir = require('laravel-elixir');
var cssScss = require('gulp-css-scss');

elixir(function(mix) {

    /**
     * Merge Javascript together
     */
    mix.scripts([
        'assets/js/ga.js',
        'assets/js/main.js'
    ], 'public/assets/app.js', 'resources/');

    /**
     * Compile Sass
     */
    mix.sass('app.scss', 'public/assets');


    mix.version(["assets/app.css", "assets/app.js"]);

});



var gulp = require('gulp');


gulp.task('css-scss', function() {

  return gulp.src('./node_modules/basscss/node_modules/**/index.css')
    .pipe(cssScss())
    .pipe(gulp.dest('./resources/assets/vendor/'));
});

