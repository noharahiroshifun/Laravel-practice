const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css');



// nodejsのインストール
// node -vコマンドでバージョン表示
// touch webpack.mix.jsコマンドでwebpack.mix.jsファイル作成
// ※このファイルがないとコマンドnpm run devでmixコマンドが見つからずエラーとなる
// コマンドnpm run dev もしくはnpm run watchでnpm実行
