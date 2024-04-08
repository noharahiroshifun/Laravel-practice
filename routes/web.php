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

Route::get('/', function () {
    return view('welcome');
    // 元からあった内容。１つのページしか設定がされていない状態
    // 第１引数「’ / ’」→このLaravelの中におけるルートディレクトリ（大元のフォルダ）のこと。
    // →Laravelの一番トップにあたる「http://127.0.0.1:8000/」のことを指している

    // 第2引数には「function() {~~」と関数が入っている
    // 関数の中身の処理が「return view('welcome');」
    // Laravelに初めから入っている、welcomeページを表示するためのファイルを呼び込んでいる
});


 Route::get('hello', [PostsController::class, 'hello']);
//register::get(index/search)

// 新規投稿の際に必要なため削除しない
Route::get('/index', [PostsController::class, 'index']);

// あいまい検索用
Route::get('/search', [PostsController::class, 'index']);
// Route::get('/search-posts', [PostsController::class, 'search']);


// 投稿フォーム画面用に追加
Route::get('/create-form', [PostsController::class, 'createForm']);

//CREATE用に追加
Route::post('/post/create', [PostsController::class, 'create']);

// UPDATE用に追加
Route::get('post/{id}/update-form', [PostsController::class, 'updateForm']);

//レコードを更新する処理用に自分で追加
Route::post('/post/update', [PostsController::class, 'update']);

//DELETE用に自分で追加
Route::get('/post/{id}/delete', [PostsController::class, 'delete']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// ログアウト時のリダイレクト先を指定
Route::post('/logout', function () {Auth::logout();return redirect('/login');})->name('logout');
// nameメソッドを使用して、ログアウトルートに名前を付ける

Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'create']);
