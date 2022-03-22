const process = require('process')
const mix = require('laravel-mix')
const webpackConfig = require('./webpack.config')

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

mix
    .copy('resources/images', 'public/images')
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .vue({ runtimeOnly: (process.env.NODE_ENV || 'production') === 'production' })
    .webpackConfig(webpackConfig)
    .babelConfig({
        plugins: ['@babel/plugin-syntax-dynamic-import']
    })
    .version()
    .sourceMaps();
