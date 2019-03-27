let mix = require('laravel-mix');

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

mix.styles([
'resources/assets/template/css/sweetalert2.min.css',
'resources/assets/template/bower_components/bootstrap/dist/css/bootstrap.min.css',
'resources/assets/template/bower_components/font-awesome/css/font-awesome.min.css',
'resources/assets/template/bower_components/Ionicons/css/ionicons.min.css',
'resources/assets/template/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
'resources/assets/template/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
'resources/assets/template/css/AdminLTE.min.css',
'resources/assets/template/css/skins/skin-blue.min.css',
'resources/assets/template/css/style.css',
], 'public/css/template.css' )
.scripts([

'resources/assets/template/bower_components/jquery/dist/jquery.min.js',
'resources/assets/template/js/app.js',
'resources/assets/template/bower_components/bootstrap/dist/js/bootstrap.min.js',
'resources/assets/template/bower_components/moment/min/moment.min.js',
'resources/assets/template/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
'resources/assets/template/js/adminlte.min.js',
'resources/assets/template/js/sweetalert2.all.min.js'

	], 'public/js/template.js')
.js(['resources/assets/js/app.js'],'public/js/app.js');


mix.browserSync({
	proxy: 'http://artvue.com',
	open: false
});

// mix.disableNotifications();
