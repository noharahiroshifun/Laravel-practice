<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
    //0419追加し直し　→0424追加の内容があるため不要
    // return view('welcome');
    // 元からあった内容。１つのページしか設定がされていない状態
    // 第１引数「’ / ’」→このLaravelの中におけるルートディレクトリ（大元のフォルダ）のこと。
    // →Laravelの一番トップにあたる「http://127.0.0.1:8000/」のことを指している

    // 第2引数には「function() {~~」と関数が入っている
    // 関数の中身の処理が「return view('welcome');」
    // Laravelに初めから入っている、welcomeページを表示するためのファイルを呼び込んでいる
// });

Route::get('/', function () { //0424追加
    return redirect('/login'); //リダイレクトでトップページにアクセスした時に自動でログインページに遷移
});

Route::get('hello', [PostsController::class, 'hello']);

// 第2引数に書いた[PostsController::class, 'hello']の箇所
// この記述では「PostsControllerのhelloメソッド」という指定を意味していいる
// →PostsController.php内にhelloメソッドを追加



// 投稿一覧画面を表示
Route::get('/index', [PostsController::class, 'index']);
// /indexにGETリクエスト送信　→PostsControllerクラスのindexメソッド実行

// あいまい検索
Route::get('/search', [PostsController::class, 'index']);
// app.blade.phpのあいまい検索機能箇所actionに/searchを指定

// 新規投稿画面を表示
Route::get('/create-form', [PostsController::class, 'createForm']);

// 新規投稿作成
Route::post('/post/create', [PostsController::class, 'create']);

// 投稿内容編集画面を表示
Route::get('post/{id}/update-form', [PostsController::class, 'updateForm']);

// 投稿内容編集
Route::post('/post/update', [PostsController::class, 'update']);

// 投稿内容削除
Route::get('/post/{id}/delete', [PostsController::class, 'delete']);

// Auth認証関連用（新規登録、ログイン、ログアウトの画面表示・処理をこれ１つで設定できる）
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');おそらく不要

// ログアウト（ログインぺージへ遷移）
Route::post('/logout', function () {Auth::logout();return redirect('/login');})->name('logout');


Route::get('/login', function () { // ログインページへのURLを/loginに変更
    return view('auth.login');
})->name('login'); // nameを追加してroute('login')で呼び出せるようにする


Route::get('/home', function () {
    return redirect('/index');
})->name('home');

// === nameメソッド ===
// 別の箇所で「route()」※()内にnameで指定した内容を記載することで、「function(){}」内の処理を実行できる
