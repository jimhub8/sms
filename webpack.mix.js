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

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css')
//     .sourceMaps();



mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/track.js', 'public/js/track.js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .sass('resources/sass/app.scss', 'public/css/main.css')
    .webpackConfig(require('./webpack.config'));


mix.styles([
    'public/css/portal.css',
    'public/css/style.css',
    'public/css/theme.css',
], 'public/css/all.css');
