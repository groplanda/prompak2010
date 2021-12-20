let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

mix.setPublicPath('./themes/voltager/assets');
mix.js('./themes/voltager/assets/src/app.js', 'dist/js')
  .sass('./themes/voltager/assets/src/app.scss', 'dist/css')
  .options({
    postCss: [
      require('postcss-url'),
      require('autoprefixer')({
        overrideBrowserslist: ['last 6 versions'],
            grid: true
      }),
      require('cssnano')({
          preset: ['default', {
              discardComments: {
                  removeAll: true,
              },
          }]
      }),
    ]
  })
  .browserSync({
    proxy: 'prompack2010',
    host: 'prompack2010',
    notify: false,
    files: [
      "./themes/voltager/assets/dist/css/*.css",
      "./themes/voltager/assets/dist/js/*.js",
      "./themes/voltager/**/*.htm",
    ]
});