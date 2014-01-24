module.exports = function(grunt) {

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        watch: {

            reload: {
                files: [
                    'cruddy/public/css/*.min.css',
                    'cruddy/public/js/*.js',
                    'app/views/**/*.php',
                ],

                options: { livereload: true },
            },
        },
    });

    grunt.loadNpmTasks('grunt-contrib-watch');

    // Default task
    grunt.registerTask('default', 'watch');
};