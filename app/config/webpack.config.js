'use strict';

// Webpack dependencies
const path = require('path');
const webpack = require('webpack');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const LiveReloadPlugin = require('webpack-livereload-plugin');
const StylelintPlugin = require('stylelint-webpack-plugin');

// Path definitions
const buildRoot = path.resolve(__dirname, '../../');
const appRoot = path.join(buildRoot, 'client/js/app');

// Theme namespace
const themename = path.join(__dirname, '../../').match(/([^\/]*)\/*$/)[1];

// PostCSS and plugins
const postcss = require('postcss');
const autoprefixer = require('autoprefixer');
const lost = require('lost');

const isProduction = -1 !== process.argv.indexOf('-p'); // eslint-disable-line no-unused-vars
const isHot = 'dev' === process.env.npm_lifecycle_event;

const plugins = [
  new ExtractTextPlugin('css/[name].css'),
];

if (isHot) {
  plugins.push(new LiveReloadPlugin({ appendScriptTag: true }));
} else {
  plugins.push(new webpack.NoErrorsPlugin());
}

module.exports = {
  // Module entry points
  entry: {
    global: 'client/js/global/global.js',
    lib: 'lib/assets/js/lib.js',
    libadmin: 'lib/assets/js/libadmin.js',
    single: 'client/js/single/single.js',
    admin: 'client/js/admin/admin.js',
    login: 'client/js/login/login.js',
  },

  // Define module outputs
  output: {
    path: 'static',
    publicPath: isHot ?
      'http://localhost:8080/static/' :
      `/wp-content/themes/${themename}/static/`,
    filename: isHot ?
      'js/[name].bundle-hot.js' :
      'js/[name].bundle.js',
  },

  // So we can put config files in config/
  eslint: {
    configFile: path.join(__dirname, '.eslintrc')
  },

  // Where webpack resolves requests
  resolve: {
    root: buildRoot,
    modulesDirectories: [
      'node_modules'
    ],
  },

  // Enable require('jquery') where jquery is already a global
  externals: {
    'jquery': 'jQuery',
  },

  plugins: [
    new ExtractTextPlugin('css/[name].css'),
    new webpack.NoErrorsPlugin(),
    new StylelintPlugin({
      configFile: path.join(__dirname, 'stylelint.config.js'),
    }),
  ],

  module: {
    preLoaders: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        loader: 'eslint'
      }
    ],
    loaders: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        loader: 'babel'
      },
      {
        test: /\.scss$/,
        loader: isProduction ? ExtractTextPlugin.extract('style-loader',
           'css?-autoprefixer' +
           '!postcss' +
           '!sass?outputStyle=compact&sourceMap=true&sourceMapContents=true'
        ) : 'style!css?-autoprefixer!postcss?parser=postcss-scss' +
            '!sass?outputStyle=expanded&sourceMap=true&sourceMapContents=true'
      },
      {
        test: /\.png(\?v=\d+\.\d+\.\d+)?$/,
        loader: 'url'
      },
      {
        test: /\.svg(\?v=\d+\.\d+\.\d+)?$/,
        loader: 'url?limit=10000&minetype=image/svg+xml'
      },
      {
        test: /\.woff(\?v=\d+\.\d+\.\d+)?$/,
        loader: 'url?limit=10000&minetype=application/font-woff'
      },
      {
        test: /\.ttf(\?v=\d+\.\d+\.\d+)?$/,
        loader: 'url?limit=10000&minetype=application/octet-stream'
      },
      {
        test: /\.eot(\?v=\d+\.\d+\.\d+)?$/,
        loader: 'file'
      },
      {
        test: /\.md$/,
        loader: 'ignore-loader'
      }
    ]
  },

  // PostCSS configuration
  postcss: () => [
    autoprefixer({ browsers: ['last 4 versions'] }),
    lost,
  ],
}
