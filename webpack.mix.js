const mix = require('laravel-mix')
require('laravel-mix-merge-manifest')

mix.setPublicPath('publishable/assets').mergeManifest()

mix.js(path.join(__dirname, '/resources/assets/js/app.js'), path.join(__dirname, '/js'))
  .postCss(path.join(__dirname, '/resources/assets/css/app.css'), path.join(__dirname, '/css'), [
    require('tailwindcss')
  ])

if (mix.inProduction()) {
  mix.version()
}
