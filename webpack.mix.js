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

mix.disableNotifications();
mix.disableSuccessNotifications();
 
mix.webpackConfig({
     stats: {
         warnings: false,
     }
});
 
mix.browserSync({
        proxy: 'http://127.0.0.1:8000'
    }).js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ])
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();
