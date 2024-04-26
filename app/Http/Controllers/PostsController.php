<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;//indexメソッド様に追加

class PostsController extends Controller
{
  // ============
  // コンストラクタ
  // ============
  public function __construct()
  {
    $this->middleware('auth');
    // このクラスを使う下記のすべての機能に対して、「ログインできているかどうか」を確認する
  }


  // ==============
  // あいまい検索機能
  // ==============
  public function index(Request $request)
  // Request $request...Laravel特有の書き方。関数がHTTPリクエストを受け取るための方法を指定する。
  // Request...５行目のuse Illuminate\Http\Request;のクラスを指定
  // $request...関数内でそのHTTPリクエストに関連する情報にアクセスするための変数

  {
    $search_content = $request->input('search_content');//ユーザーが入力した検索ワードを取得

    // もし検索キーワードがあれば、そのキーワードで検索を行う
    if ($search_content) {
        $lists = DB::table('posts')
                    ->where('contents', 'like', '%' . $search_content . '%')
                    // contents...カラム指定(投稿内容)
                    // like...部分一致の指定
                    // '%' . $search_content . '%'...検索文字列の指定。
                    ->get();
    // そうでない場合（検索キーワードがなければ）すべての投稿を表示
    } else {
        $lists = DB::table('posts')->get();
        //whereの指定をしないことですべての投稿を取得
    }

    if ($lists->isEmpty()) {
        return view('posts.index', ['lists' => $lists])->with('message', '検索結果は0件です。');
    }

    // 検索結果がある場合は、そのまま投稿一覧を表示
    return view('posts.index', ['lists' => $lists]);
  }
  //'posts.index'...ディレクトリ指定。index.blade.phpのこと
  //  ['lists' => $lists]...posts.index（ビュー（ページ))にデータを渡すため必要（$lists変数を使って投稿の一覧を表示する）


  // ==============
  // 新規投稿画面表示
  // ==============
  public function createForm()
  {
    return view('posts.createForm');
  }


  // ==============
  // 新規投稿機能
  // ==============
  public function create(Request $request)
  // 登録処理の実装のためにブラウザ表示をしない、登録処理だけを行うメソッドを追加
  // 「GETパラメータ」つまり「ユーザーID」をコントローラーで受け取るための処理
  // $request(引数)→POSTでフォームが送られる時にこの引数に値が渡される
  {
    $request->validate([ //0419修正追加
    'newPost' => 'required|string|not_regex:/^[^\s\u3000]*$/u'//0424追加

    ], [
    'newPost.required' => '投稿内容は必須です。',
    'newPost.not_regex' => '投稿内容は必須です。'
    ]);

    $userName = auth()->user()->name;
    // auth()->user()->nameは...現在のログインユーザー(auth()->user()-)の名前(->name)を取得
    $post = $request->input('newPost');
    //ユーザーがフォームで送信した'newPost'という名前のフィールドの値を取得
    // newPost...createform.blade.phpで使用

    // 投稿内容が100文字以上の場合はエラーメッセージを表示して処理を中断
    if (strlen($post) >= 100) {
        return redirect('/create-form')->with('error', '100文字以上での投稿はできないので、文字数を減らしてみましょう！');
        // /create-form'...「/」を入れて絶対パスで指定
        // errorキーに文字列を保存
    }

    // 投稿内容をDBに追加
    DB::table('posts')->insert([
      // insert...レコード追加
        'user_name' => $userName, //ユーザー名追加
        'contents' => $post //投稿内容追加
    ]);

    // 投稿一覧画面にリダイレクト
    return redirect('/index');
  }


  // ==================
  // 投稿内容編集画面の表示
  // ==================
  public function updateForm($id)
  // $idから該当する投稿を取得
  {
    $post = DB::table('posts')->where('id', $id)->first();
    // DB::table('posts')...()内の名前の表の情報を取得
    // where('id', $id)...idが$idと同じものを探す
    return view('posts.updateForm', ['post' => $post]);
  }


  // ==============
  // 投稿内容編集機能
  // ==============
  public function update(Request $request)
  {
    $request->validate([ //0419修正追加
     'upPost' => 'required|string|not_regex:/^[^\s\u3000]*$/u'//0424追加
    ], [
      'upPost.required' => '投稿内容は必須です。',
      'upPost.not_regex' => '投稿内容は必須です。'
    ]);

    $id = $request->input('id');
    $up_post = $request->input('upPost');
    // [name]属性が[id][upPost]で指定されているフォームの値を別々の変数で取得


    // 追加：更新後の投稿内容が100文字以上の場合はエラーメッセージを表示して処理を中断
    if (strlen($up_post) >= 100) {
      return redirect("/post/$id/update-form")->with('error', '100文字以上での投稿はできないので、文字数を減らしてみましょう！');
    }

    DB::table('posts')
      ->where('id', $id)
      // 受け取ったidと一致した投稿を対象
      ->update(['contents' => $up_post]);
      // postsテーブルのレコードを更新

    return redirect('/index');
    // リダイレクトで投稿一覧ページのURLを指定
  }


  // ==============
  // 投稿内容削除機能
  // ==============
  public function delete($id)
  {
    DB::table('posts')
      ->where('id', $id)
      ->delete();
    return redirect('/index');
  }

}



// function...関数の呼び出し


// === スコープ演算子 ===
// ::...静的メソッドやプロパティ（今回はdb）にアクセスするために必要


//=== HTTPリクエスト ===
// 「ブラウザ」から「Webサーバー」に送信される（要求される）もの。
// 例:アクセスしたいページのURL / 投稿内容 / 検索ワード /アドレス・パスワードなど


// === アロー演算子 ===
// ->...アクセスする
// $XXX->YYY...$XXXの中にあるYYYにアクセスする

// =>...関連づける（追加する）
// 'XXX' => 'YYY'..."XXX"という[名前]に"YYY"という[値]を関連付づける
// →何が入っているかを明確にする時に便利
// ==================
