<?php

namespace App\Http\Controllers\Auth;
// namespace...クラスや関数の名前が被らないように、どの階層（ネームスペース）に属している〇〇（クラスや関数名）と示してくれる

use App\Http\Controllers\Controller;//Controller...他のコントローラークラスの基底となる共通の機能を提供
use App\Providers\RouteServiceProvider;//RouteServiceProvider...ルーティングに関する機能を提供
use Illuminate\Foundation\Auth\AuthenticatesUsers;//AuthenticatesUsersユーザーの認証に関する機能が追加
// use...別の場所にある各機能を使うために必要


class LoginController extends Controller
// LoginController という名前のクラスを定義し、Controller クラスを継承
// これによってコントローラーの基本的な機能を使える
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/index';
    // ユーザーがログインした後にリダイレクトされる場所を指定


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    // コンストラクタ（自動で呼び出されるメソッド）
    {
        $this->middleware('guest')->except('logout');
        // $this...現在のインスタンス（redirectTo）のこと
        // middleware...リクエストがルートに到達する前に実行されるメソッド
        // →ログインするときにユーザーがゲスト（ログインしていない）状態かどうかを確認
        // expect...例外指定メソッド
        // 　→ログアウトする時にはmiddlewareメソッドが適用されないようにする（ログアウトの時にログインページにリダイレクトしないようにする）
    }

}

