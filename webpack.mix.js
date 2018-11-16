const mix = require('laravel-mix');
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