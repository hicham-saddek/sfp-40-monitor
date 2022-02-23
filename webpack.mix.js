const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js').vue()
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .webpackConfig(require('./webpack.config')).sourceMaps(mix.inProduction());

if (mix.inProduction()) {
    mix.version().minify('public/js/app.js', 'public/js/app.min.js');
}else{
    mix.browserSync({
        proxy: "https://sfp40monitor.milebits.com:3005/",
        port: 3005,
        https: {
            key: "/home/milebits/sfp40monitor.milebits.com/resources/certificates/ssl.key",
            cert: "/home/milebits/sfp40monitor.milebits.com/resources/certificates/ssl.cert",
        },
        online: true,
        open: true,
        cors: true,
        host: "sfp40monitor.milebits.com",
        ui: false,
    });
}
