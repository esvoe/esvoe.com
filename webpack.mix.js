const { mix } = require('laravel-mix');

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

mix.less('./node_modules/bootstrap-less/bootstrap/bootstrap.less', './public/themes/default/assets/css/bootstrap.css')
	.less('./public/themes/default/assets/less/style.less','./public/themes/default/assets/css/main.css')
	.combine([
		'./public/themes/default/assets/css/bootstrap.css',
		'./public/themes/default/assets/css/animate.css',
		'./public/themes/default/assets/css/font-awesome.min.css',
		'./public/themes/default/assets/css/datepicker.css',
		'./public/themes/default/assets/css/bootstrap-datetimepicker.css',
		'./public/themes/default/assets/css/jquery-confirm.min.css',
		'./public/themes/default/assets/css/selectize.css',
		'./public/themes/default/assets/css/selectize.bootstrap3.css',
		'./public/themes/default/assets/css/emojify.css',
		'./public/themes/default/assets/css/jquery.mCustomScrollbar.css',
		'./public/themes/default/assets/css/lightbox.min.css',
		'./public/themes/default/assets/css/lightgallery.css',
		'./public/themes/default/assets/css/main.css'
	], 'public/themes/default/assets/css/style.css')
	.combine([
		'./public/themes/default/assets/js/jquery.min.js',
		'./public/themes/default/assets/js/jquery-ui-1.10.3.custom.min.js',
		'./public/themes/default/assets/js/bootstrap.min.js',
		'./public/themes/default/assets/js/jquery/moment.js',
		'./public/themes/default/assets/js/jquery.form.js',
		'./public/themes/default/assets/js/jquery.timeago.js',
		'./public/themes/default/assets/js/login.js',
		'./public/themes/default/assets/js/bootstrap-datepicker.js',
		'./public/themes/default/assets/js/bootstrap-datetimepicker.js',
		'./public/themes/default/assets/js/jquery-confirm.min.js',
		'./public/themes/default/assets/js/jquery.noty.packaged.min.js',
		'./public/themes/default/assets/js/selectize.min.js',
		'./public/themes/default/assets/js/jquery.jscroll.js',
		'./public/themes/default/assets/js/jquery.mCustomScrollbar.concat.min.js',
		'./public/themes/default/assets/js/emojify.js',
		'./public/themes/default/assets/js/bootstrap-typeahead.js',
		'./public/themes/default/assets/js/mention.js',
		'./public/themes/default/assets/js/playSound.js',
		'./public/themes/default/assets/js/pusher.min.js',		
		'./public/themes/default/assets/js/vue.js',
		'./public/themes/default/assets/js/vue-resource.min.js',
		'./public/themes/default/assets/js/tinymce/tinymce.min.js',
		'./public/themes/default/assets/js/linkify.min.js',
		'./public/themes/default/assets/js/linkify-jquery.min.js',
		], 'public/themes/default/assets/js/main.js')
	.version();
