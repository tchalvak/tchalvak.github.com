/* global __dirname */
const path = require('path')

module.exports = {
    entry: './src/index.js',
    output: {
        filename: 'main.js',
        path: path.resolve(__dirname, 'dist'),
        publicPath: '/dist/', // Tells the server where the bundled file lives virtually
    },
    devServer: {
        static: {
            directory: path.resolve(__dirname, './'), // Serves your root index.html
        },
        watchFiles: ['./index.html', './src/**/*'], // Reloads browser if index.html or source changes
    }
}
