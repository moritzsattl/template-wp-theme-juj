// webpack.mix.js

let mix = require('laravel-mix');

mix.sass('assets/scss/app.scss', 'dist').options({
    processCssUrls: false
});

mix.js('assets/js/script.js', 'dist');
//mix.js('template-parts/../script.js', 'dist');