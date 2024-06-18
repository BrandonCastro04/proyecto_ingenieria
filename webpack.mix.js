const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .vue() // Habilita el soporte para Vue
   .sass('resources/sass/app.scss', 'public/css');


