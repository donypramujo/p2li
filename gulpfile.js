var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.styles([
        'bootstrap.css',
        'animate.css',
        'font-awesome.min.css',
        'font.css',
        '../js/select2/select2.css',
        '../js/datepicker/datepicker.css',
        '../js/select2/theme.css',
        '../js/lightbox-4.0.1/ekko-lightbox.css',
        'app.css'
    ]);
});


elixir(function(mix) {
    mix.styles([
        'bootstrap.css',
        'animate.css',
        'font-awesome.min.css',
        'font.css',
        '../js/select2/select2.css',
        '../js/select2/theme.css',
        '../js/lightbox-4.0.1/ekko-lightbox.css',
        'landing.css',
        'app.css'
    ], 'public/css/landing.css');
});

elixir(function(mix) {
    mix.scripts([
        'jquery.min.js',
        'bootstrap.js',
        'app.js',
        'slimscroll/jquery.slimscroll.min.js',
        'select2/select2.min.js',
        'datepicker/bootstrap-datepicker.js',
        'sortable/jquery.sortable.js',
        'file-input/bootstrap-filestyle.min.js',
        'lightbox-4.0.1/ekko-lightbox.js',
        'app.plugin.js'
    ]);
});

elixir(function(mix) {
    mix.scripts([
        'jquery.min.js',
        'bootstrap.js',
        'app.js',
        'slimscroll/jquery.slimscroll.min.js',
        'appear/jquery.appear.js',
        'scroll/smoothscroll.js',
        'landing.js',
        'select2/select2.min.js',
        'app.plugin.js',
        'lightbox-4.0.1/ekko-lightbox.js',
    ], 'public/js/landing.js');
});

elixir(function(mix) {
    mix.scripts([
         'ie/html5shiv.js', 
         'ie/respond.min.js',
         'ie/excanvas.js'],
         'public/js/ie-plugin.js');
	});
