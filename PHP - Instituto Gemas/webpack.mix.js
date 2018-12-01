let mix = require('laravel-mix');
let webpack = require('webpack');

mix.webpackConfig({
    plugins: [
        new webpack.ProvidePlugin({
            $: "jquery",
            jQuery: "jquery"
        }),

    ],
});


mix.styles([
    'node_modules/bootstrap/dist/css/bootstrap.min.css',
    'node_modules/font-awesome/css/font-awesome.css',
    'node_modules/lightgallery/dist/css/lightgallery.min.css',
    'node_modules/lightgallery/dist/css/lg-transition.min.css',
], 'public/css/vendor.min.css').version();
// pegando as fonts das bibliotecas
mix.copy('node_modules/bootstrap/fonts/*', 'public/fonts');
mix.copy('node_modules/font-awesome/fonts/*', 'public/fonts');
// pegando arquivos de terceiros
mix.copy('node_modules/lightGallery/dist/fonts/*', 'public/fonts');
mix.copy('node_modules/lightGallery/dist/img/*', 'public/img');
mix.styles([
    'resources/assets/site/css/theme/*',
], 'public/css/site.min.css').version();

mix.js('resources/assets/site/js/home.js', 'public/js/home.js')
    .version()
    .extract(['jquery', 'bootstrap', 'jquery.scrollto']).version();

mix.js('resources/assets/site/js/evento.js', 'public/js/evento.js')
    .version();

// ===================================


// copiando icones
mix.copy('resources/assets/site/img/*', 'public/img').version();
mix.copy('resources/assets/site/img/favicon/', 'public/img/');
mix.copy('resources/assets/site/browserconfig.xml', 'public/');
mix.copy('resources/assets/site/manifest.json', 'public/');