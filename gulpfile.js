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
//        '../js/calendar/bootstrap_calendar.css',
        'app.css'
    ]);
});

elixir(function(mix) {
    mix.scripts([
        'jquery.min.js',
        'bootstrap.js',
        'app.js',
        'slimscroll/jquery.slimscroll.min.js',
        'charts/easypiechart/jquery.easy-pie-chart.js',
        'charts/sparkline/jquery.sparkline.min.js',
        'charts/flot/jquery.flot.min.js',
        'charts/flot/jquery.flot.tooltip.min.js',
        'charts/flot/jquery.flot.resize.js',
        'charts/flot/jquery.flot.grow.js',
//        'calendar/bootstrap_calendar.js',
//        'calendar/demo.js',
        'sortable/jquery.sortable.js',
        'app.plugin.js'
    ]);
});

elixir(function(mix) {
    mix.scripts([
         'ie/html5shiv.js', 
         'ie/respond.min.js',
         'ie/excanvas.js'],
         'public/js/ie-plugin.js');
	});
