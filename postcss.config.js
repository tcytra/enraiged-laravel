export default {
    syntax: 'postcss-scss',
    plugins: {
        'postcss-import': {},
        'postcss-mixins': {},
        'postcss-nested': {},
        'postcss-simple-vars': {},
        'postcss-lighten-darken': {}, // must come after postcss-simple-vars
        autoprefixer: {},
        cssnano: {preset: 'default'}
    },
};
