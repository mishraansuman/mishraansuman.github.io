/**
 * External Dependencies
 */

 /**
  * WordPress Dependencies
  */
 const defaultConfig = require( '@wordpress/scripts/config/webpack.config.js' );
 const webpack = require( 'webpack' );
 
 module.exports = {
     ...defaultConfig,
     ...{
         entry: {
            index: './src/index.js',
            gspbLibrary: './src/gspb-library/index.js',
            gspbCustomEditor: './src/customJS/editor/index.js',
         },
         resolve: {
            fallback: {
                "http": false
            },
         },
         plugins: [
            ...defaultConfig.plugins,
            new webpack.ProvidePlugin({
                   process: 'process/browser',
            }),
        ],
     }
 }