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

elixir.config.sourcemaps = false;

elixir(function(mix) {
  mix.less(["styles.less" ], "public/css/styles.css",  "resources/assets/");
  mix.less(["admin.less"  ], "public/css/admin.css",   "resources/assets/");
  mix.less(["student.less"], "public/css/student.css", "resources/assets/");

  mix.styles([
    "bootstrap/dist/css/bootstrap.min.css",
    "material-design-lite/material.min.css",
    //"malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css",
    //"foundation/css/foundation-slider.min.css",
    ], "public/css/library.css", "resources/assets/");

  mix.scripts([
    "jquery/dist/jquery.min.js",
    "angular/angular.min.js",
    "angular-route/angular-route.min.js",
    "material-design-lite/material.min.js",
    //"angular-filter/dist/angular-filter.min.js",
    "bootstrap/dist/js/bootstrap.min.js",
    //"malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js",
    //"retina.js/dist/retina.min.js",
    //"foundation/js/foundation.min.js",
    //"foundation/js/foundation.slider.js",
    //"sortable/Sortable.min.js"
    ], "public/js/library.js", "resources/assets/")
});
