module.exports = function(grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    /**
    *
    * Set project object
    *
    **/
    project: {
        app: 'app',
        assets: '<%= project.app %>/assets',

        src_js: '<%= project.assets %>/scripts',
        src_css: '<%= project.assets %>/styles',
        src_scss: '<%= project.assets %>/styles/sass/main.scss',

        dist: 'public/assets',
        dist_js: '<%= project.dist %>/scripts',
        dist_css: '<%= project.dist %>/styles',
    },

    /**
    *
    * SASS
    * Preprocess all the scss-files!
    *
    **/
    sass: {
        dev: {
            options: {
                style: 'expanded'
            },
            files: {
                '<%= project.dist_css %>/main.min.css': '<%= project.src_scss %>'
            }
        },
        dist: {
            options: {
                style: 'compressed'
            },
            files: {
                '<%= project.dist_css %>/main.min.css': '<%= project.src_scss %>'
            }
        }
    },


    /**
    *
    * Concat Files together
    *
    **/
    concat: {
        options: {
            separator: ';'
        },

        //Javascript
        vendor_js: {
            src: [
                'app/assets/bower/jquery/dist/jquery.js'
                ],
            dest: '<%= project.dist_js %>/vendor.min.js',
        },
        main_js: {
            src: [
                'app/assets/scripts/main.js'
                ],
            dest: '<%= project.dist_js %>/main.min.js',
        }

    },

    //Minify Javacsript Files
    uglify: {
        dist: {
            files: {
                '<%= project.dist_js %>/main.min.js': ['<%= concat.main_js.dest %>'],
                '<%= project.dist_js %>/vendor.min.js': ['<%= concat.vendor_js.dest %>']
            }
        }
    },


    // jshint: {
    //   files: ['Gruntfile.js', '<%= project.src_js %>/**/*.js'],
    //   options: {
    //     // options here to override JSHint defaults
    //     globals: {
    //       jQuery: true,
    //       console: true,
    //       module: true,
    //       document: true
    //     }
    //   }
    // },

    /**
    *
    * Overserve some files
    *
    **/

    watch: {
        concat: {
            files: ['<%= project.src_js %>/**/*.js' ],
            tasks: ['concat', 'uglify']
        },
        sass: {
            files: ['<%= project.src_css %>/scss/{,*/}*.{scss,sass}' ],
            tasks: ['sass:dev']
        }

    },

    /**
    *
    * Minify CSS Files
    *
    **/

    cssmin: {
        minify: {
            expand: true,
            cwd: '<%= project.src_css %>',
            src: ['*.css', '!*.min.css'],
            dest: '<%= project.dist_css %>',
            ext: '.min.css'
        }
    }

  });

    /**
    *
    * Load all Grunt Plugins dynamically
    *
    **/
    require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

    /**
    *
    * Setup Grunt Tasks
    *
    **/
    grunt.registerTask('default', ['concat', 'uglify']);
    grunt.registerTask('sass-dev', ['newer:sass:dev', 'newer:watch:sass']);

};