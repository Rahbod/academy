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

mix.setPublicPath('/');

mix.webpackConfig({ output: { filename: '[name].js', chunkFilename: 'assets/vue/lazy-routes/[name].js', publicPath: '/' } });

mix.js('resources/js/admin/system_management.js', 'assets/vue/system_management.js').autoload({});
// mix.js('resources/js/admin/site_management.js', 'assets/vue/site_management.js').autoload({});
mix.js('resources/js/admin/admin.js', 'assets/vue/admin.js').autoload({});
//
// mix.js('resources/js/app.js', 'public/js')
//    .sass('resources/sass/app.scss', 'public/css');
