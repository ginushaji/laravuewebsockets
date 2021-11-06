const mix = require('laravel-mix');
const WebpackShellPluginNext  = require('webpack-shell-plugin-next');

mix.webpackConfig({
    plugins:
    [
        new WebpackShellPluginNext({
            onBuildStart: ['php artisan lang:js resources/js/vue-translations.js --no-lib --quiet'],
            onBuildEnd: []
        })
    ]
});

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

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css');
