var elixir = require('laravel-elixir');

var paths = {
    bootstrap: 'node_modules/bootstrap-sass/assets/',
    simplemde: 'node_modules/simplemde/dist/',
    fontawesome: 'node_modules/font-awesome/',
    jquery: 'bower_components/jquery/dist/',
    chosen: 'bower_components/chosen/',
}

elixir.config.sourcemaps = false;

elixir(function(mix) {
    mix.copy(paths.bootstrap + 'fonts/bootstrap/**', 'public/fonts/bootstrap')
        .copy(paths.bootstrap + 'javascripts/bootstrap.min.js', 'public/js/lib')
        .copy(paths.fontawesome + 'fonts/fontawesome-webfont.*', 'public/fonts')
        .copy(paths.simplemde + 'simplemde.min.css', 'public/css/lib')
        .copy(paths.simplemde + 'simplemde.min.js', 'public/js/lib')
        .copy(paths.jquery + 'jquery.min.js', 'public/js/lib')
        .copy(paths.chosen + 'chosen.min.css', 'public/css/lib')
        .copy(paths.chosen + 'chosen-sprite.png', 'public/css/lib')
        .copy(paths.chosen + 'chosen-sprite@2x.png', 'public/css/lib')
        .copy(paths.chosen + 'chosen.jquery.min.js', 'public/js/lib')
        .sass('app.scss')
        .scripts('app.js');
});
