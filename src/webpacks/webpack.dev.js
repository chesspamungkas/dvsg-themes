const defaultConfig = require("@wordpress/scripts/config/webpack.config");
const postcssPresetEnv = require( 'postcss-preset-env' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const IgnoreEmitPlugin = require( 'ignore-emit-webpack-plugin' );
const production = process.env.NODE_ENV === '';
const path = require('path');


module.exports = {
  ...defaultConfig,
  module: {
    ...defaultConfig.module,
    rules: [
      ...defaultConfig.module.rules,
	  {
		test: /\.(ttf|eot|woff|woff2|svg)$/,
		use: {
			loader: 'file-loader',
			//include: path.resolve(__dirname, './src/webfonts'),
			options: {
				name: '[name].[ext]',
				outputPath: 'fonts/'
			},
		},
		},
      {
				test: /\.(sc|sa|c)ss$/,
				exclude: /node_modules/,
				use: [
					{
						loader: MiniCssExtractPlugin.loader,
					},
					{
						loader: 'css-loader',
						options: {
							sourceMap: ! production,
						},
					},
					{
						loader: 'postcss-loader',
						options: {
							ident: 'postcss',
							plugins: () => [
								postcssPresetEnv( {
									stage: 3,
									features: {
										'custom-media-queries': {
											preserve: false,
										},
										'custom-properties': {
											preserve: true,
										},
										'nesting-rules': true,
									},
								} ),
							],
						},
					},
					{
						loader: 'sass-loader',
						options: {
							sourceMap: ! production,
						},
					},
				],
			},
    ],
    
  },
  plugins: [
    ...defaultConfig.plugins,
    new MiniCssExtractPlugin( {
      filename: '[name].css',
    } ),
  ],
};