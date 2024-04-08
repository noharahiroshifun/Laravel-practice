<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//indexメソッド様に追加
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
  // auth機能をPostsContorller.phpのコンストラクタとして設定することにより、
  // Postsコントローラーが管理する画面に共通して適用
  // このauth機能は、大まかにいうと「ログインできているかどうか」を確認するもの
  public function __construct()
  {
    $this->middleware('auth');
  }


  // あいまい検索機能


  // indexメソッドの修正
      public function index(Request $request)
      {
          $search_content = $request->input('search_content');

          // もし検索キーワードがあれば、そのキーワードで検索を行う
          if ($search_content) {
              $lists = DB::table('posts')
                          ->where('contents', 'like', '%' . $search_content . '%')
                          ->get();
          } else {
              $lists = DB::table('posts')->get();
          }

          if ($lists->isEmpty()) {
              return view('posts.index', ['lists' => $lists])->with('message', '検索結果は0件です。');
          }

          // 検索結果がある場合は、そのまま投稿一覧を表示
          return view('posts.index', ['lists' => $lists]);
      }



//     public function index(Request $request)
// {
//     $search_content = $request->input('search_content');

//     if ($search_content) {
//         $lists = DB::table('posts')
//                     ->where('contents', 'like', '%' . $search_content . '%')
//                     ->paginate(10);
//         // 検索結果が0件の場合の処理
//         if ($lists->isEmpty()) {
//             return view('posts.index')->with('message', '検索結果は0件です。');//存在しないワードで検索した場合に表示
//         }
//     } else {
//         $lists = DB::table('posts')->paginate(10);
//     }
//     return view('posts.index', ['lists' => $lists]);
// }

   // CREATE用にメソッド追加
  public function createForm()
  {
    return view('posts.createForm');
  }



  // CREATE用の処理（表示しない）
  // 「GETパラメータ」つまり「ユーザーID」をコントローラーで受け取るための処理
// public function create(Request $request)
// {
//     $userName = auth()->user()->name; // ログインユーザー名を取得
//     $post = $request->input('newPost');// フォームから投稿内容とユーザー名を取得

//     // 投稿内容をDBに追加
//     DB::table('posts')->insert([
//         'user_name' => $userName,
//         'contents' => $post
//     ]);

//     // 投稿一覧画面にリダイレクト
//     return redirect('/index');

// }

public function create(Request $request)
{
    $userName = auth()->user()->name; // ログインユーザー名を取得
    $post = $request->input('newPost');// フォームから投稿内容とユーザー名を取得

    // 追加：投稿内容が100文字以上の場合はエラーメッセージを表示して処理を中断
    if (strlen($post) >= 100) {
        return redirect('/create-form')->with('error', '100文字以上での投稿はできないので、文字数を減らしてみましょう！');
    }

    // 投稿内容をDBに追加
    DB::table('posts')->insert([
        'user_name' => $userName,
        'contents' => $post
    ]);

    // 投稿一覧画面にリダイレクト
    return redirect('/index');
}



  //     // UPDATE用メソッド
  // public function updateForm($id)
  // {
  //   $post = DB::table('posts')
  //     // $post変数...データベースから取得した特定の投稿を格納
  //     // DBのどのテーブルに対してクエリを行うかを指定 →postsテーブルを指定
  //     ->where('id', $id)
  //     // postsテーブル内でid列が[1]に一致する投稿を選択するように指定
  //     // →ルーディングGETの送信ルールに従ってidを追加
  //     // 名前は揃えなくても機能するが、みやすくするために統一
  //     // where区によって更新したい投稿のIDを受け取り、その投稿の現在の内容を取得
  //     ->first();
  //   // 条件に一致する最初の投稿を取得するメソッド
  //   // ＝＝＝＝＝＝＝※「>」を「->」に変更（chatGPT参照）してエラー解消＝＝＝＝＝＝＝
  //   return view('posts.updateForm', ['post' => $post]);
  // }



  // updateFormメソッド修正
public function updateForm($id)
{
    // 投稿を取得
    $post = DB::table('posts')->where('id', $id)->first();
    return view('posts.updateForm', ['post' => $post]);
}



    // レコード更新処理用メソッド（表示しない）
  // public function update(Request $request)
  // {
  //   $id = $request->input('id');
  //   $up_post = $request->input('upPost');
  //   // ①[name]属性が[id][upPost]で指定されているフォームの値を別々の変数で取得

  //   DB::table('posts')
  //     ->where('id', $id)
  //     // ②受け取ったidと一致した投稿を対象にしている

  //     ->update(
  //       ['contents' => $up_post]
  //       // 投稿内容なのでcontents
  //       // ②postsテーブルのレコードを更新
  //     );

  //   return redirect('/index');
  //   // ③リダイレクトで投稿一覧ページのURLを指定
  // }


  public function update(Request $request)
{
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



// DELETE用メソッド（表示しない）
  public function delete($id)
  {
    DB::table('posts')
      ->where('id', $id)
      ->delete();
    return redirect('/index');
  }

}
