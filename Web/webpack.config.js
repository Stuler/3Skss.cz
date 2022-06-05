const path = require('path');

module.exports = {
	entry        : __dirname + "/js/app.js",
	mode         : (process.env.NODE_ENV === 'production') ? 'production' : 'development',
	resolve      : {
		extensions: ['*', '.js', '.jsx']
	},
	resolveLoader: {
		modules: [
			'node_modules',
		]
	},
	output       : {
		filename  : 'bundle.js',
		path      : __dirname + "/www/assets",
		publicPath: "/assets/",
	},
	devServer    : {
		static  : {
			directory: path.join(__dirname, 'assets'),
		},
		compress: true,
		port    : 8000,
	},
}