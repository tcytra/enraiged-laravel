module.exports = {
    syntax: 'postcss-scss',
    plugins: [
        require('postcss-import'),
        require('postcss-mixins'),
        require('postcss-nested'),
        require('postcss-simple-vars'),
        require('postcss-lighten-darken'), // must come after postcss-simple-vars
        require('autoprefixer'),
        require('cssnano')({ preset: 'default' }),
    ]
};
