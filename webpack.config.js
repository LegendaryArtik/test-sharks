let SVGSpritemapPlugin = require('svg-spritemap-webpack-plugin');
const path = require('path');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');

module.exports = {
    mode: 'development',
    entry: './assets/main.js',
    output: {
        path: path.resolve(__dirname, 'build/'),
        filename: 'scripts.js'
    },
    plugins: [
        new CleanWebpackPlugin(),
        new SVGSpritemapPlugin('./assets/images/svg/*.svg', {
            output: {
                filename: './sprite.svg',
                chunk: {keep: true},
                svg: {
                    sizes: false,

                },
                svgo: false,
            },
            sprite: {
                generate: {
                    title: false,
                },
                prefix: 'i-',
            }
        })
    ]
}

