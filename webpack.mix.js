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

/*
.extract([
       'jquery',
    ])
   .autoload({
       jquery: ['$', 'window.jQuery', 'jQuery', 'jquery']
   })

*/

mix.js('resources/js/app.js', 'public/js')
    .extract([
        'jquery', 
        'datatables.net-bs4', 'datatables.net-buttons-bs4', 
        'sweetalert',
        'select2',
        'bootstrap-notify',
        'fullcalendar',
        'moment',
        'axios',
    ])
    .autoload({
        jquery: ['$']
    })
    .sass('resources/sass/app.scss', 'public/css')
    .version()
    .browserSync({
        proxy: 'turnos.test',
        files: [
            'app/**/*.php',
            'resources/views/**/*.php',
            'public/js/**/*.js',
            'public/css/**/*.css'
        ]
    });



