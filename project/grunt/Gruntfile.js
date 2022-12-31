module.exports = function(grunt) {
    // Do grunt-related things in here
    
    var currentdate = new Date();
    var datetime = currentdate.getDate() + "/"
    + (currentdate.getMonth() +1) + "/"
    + currentdate.getFullYear() + " @ "
    + currentdate.getHours() + ":"
    + currentdate.getMinutes() + ":"
    + currentdate.getSeconds();
    
    // Project configuration.
    grunt.initConfig({
        concat: {
            options: {
                separator: '\n',
                sourceMap: true,
                banner: "/* Processed by Grunt on "+ datetime +" */\n\n",
            },
            css: {
                src: [
                    '../css/**/**.css',
                    'node_modules/hover.css/css/hover.css',
                    'node_modules/bootstrap/dist/css/bootstrap.css',
                ],
                dest: '../../htdocs/css/styles.css',
            },
            js: {
                src: [
                    '../js/**/**.js',
                    'node_modules/jquery/dist/jquery.js',
                    'node_modules/bootstrap/dist/js/bootstrap.bundle.js'
                ],
                dest: '../../htdocs/js/app.js',
            },
        },
        cssmin: {
            options: {
                mergeIntoShorthands: false,
                roundingPrecision: -1
            },
            target: {
                files: {
                    'output.css': ['foo.css', 'bar.css']
                }
            }
        },
        uglify: {
            minify: {
                options: {
                    sourceMap: true,
                    sourceMapName: 'path/to/sourcemap.map'
                },
                files: {
                    'dest/output.min.js': ['src/input.js']
                }
            }
        },
        copy: {
            jquery: {
                files: [
                    // Include files within path and its sub-directories
                    {
                        expand: true,
                        src: ['node_modules/jquery/dist/jquery.js'],
                        dist: '../../htdocs/js/jquery/jquery.js',
                    }
                ],
            },
            bootstrap: {
                files: [
                    // Include files within path and its sub-directories
                    {
                        expand: true,
                        src: ['node_modules/bootstrap/dist/js/bootstrap.bundle.js'],
                        dist: '../../htdocs/js/bootstrap/bootstrap.bundle.js',
                    }
                ],
            }
        },
        watch: {
            css: {
                files: ['../css/**/*.css'],
                tasks: ['concat:css', 'cssmin'],
                options: {
                    spawn: false,
                },
            },
            js: {
                files: ['../css/**/*.js'],
                tasks: ['concat:js', 'uglify'],
                options: {
                    spawn: false,
                },
            }
        },
    });
    
    
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.registerTask('default', ['copy', 'concat', 'cssmin', 'uglify', 'watch']);
};
