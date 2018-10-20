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
    ])
    .autoload({
        jquery: ['$', 'window.jQuery', 'jQuery', 'jquery']
    })
    .sass('resources/sass/app.scss', 'public/css')
    .version()
    .sourceMaps()
    .browserSync({
        proxy: 'turno.test',
        files: [
            'app/**/*.php',
            'resources/views/**/*.php',
            'public/js/**/*.js',
            'public/css/**/*.css'
        ]
    });



