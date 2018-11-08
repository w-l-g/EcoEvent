var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()

    // Fichiers JS
    .autoProvidejQuery()
    .addEntry('app', './assets/js/app.js')

    // Fichiers CSS
    .addStyleEntry('main', './assets/css/main.scss')


    .enableSassLoader(function (sassOptions) {
    }, {
        resolveUrlLoader: false
    })
    .autoProvideVariables({
        Popper: 'popper.js'
    })
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning()
    .enablePostCssLoader((options) => {
        options.config = {
            path: 'postcss.config.js'
        };
    })
;

module.exports = Encore.getWebpackConfig();

/*var config = Encore.getWebpackConfig();

//disable amd loader
config.module.rules.unshift({
    parser: {
        amd: false,
    }
});

module.exports = config;*/
