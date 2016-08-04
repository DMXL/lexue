var elixir = require('laravel-elixir');

elixir.config.assetsPath = 'resources/assets/app/'; //trailing slash required.

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
    mix.less('inspinia/style.less', 'public/app/css');

    mix.styles([
        'bootstrap.min.css',
        'animate.css',
        'plugins/font-awesome/font-awesome.min.css',
        'plugins/toastr/toastr.min.css',
        'plugins/select2/select2.min.css',
        'plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css',
        'plugins/touchspin/jquery.bootstrap-touchspin.min.css',
        'plugins/pickadate/default.css',
        'plugins/pickadate/default.date.css',
        'plugins/pickadate/default.time.css',
        'plugins/selectize/selectize.css',
        'plugins/selectize/selectize.bootstrap3.css',
    ], 'public/app/css');

    mix.scripts([
        'jquery-2.1.1.js',
        'bootstrap.min.js',
        'plugins/metisMenu/jquery.metisMenu.js',
        'plugins/slimscroll/jquery.slimscroll.min.js',
        'inspinia.js',
        'plugins/pace/pace.min.js',
        'plugins/jquery-ui/jquery-ui.custom.min.js',
        'plugins/sparkline/jquery.sparkline.min.js',
        'plugins/toastr/toastr.min.js',
        'plugins/toastr/custom.js',
        'plugins/select2/select2.full.min.js',
        'plugins/touchspin/jquery.bootstrap-touchspin.min.js',
        'plugins/pickadate/picker.js',
        'plugins/pickadate/picker.date.js',
        'plugins/pickadate/picker.time.js',
        'plugins/selectize/selectize.min.js',
        'plugins/moment/moment.js',
        'vue.min.js'
    ], 'public/app/js');

    mix.version(['app/css/all.css', 'app/css/style.css', 'app/js/all.js']);

    mix.copy('resources/assets/app/fonts', 'public/build/app/fonts');
    mix.copy('resources/assets/app/patterns', 'public/build/app/css/patterns');
    mix.copy('resources/assets/app/avatars', 'public/avatars');
});
