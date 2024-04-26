<?php

namespace App\Http\Controllers\Auth;
// namespace...クラスや関数の名前が被らないように、どの階層（ネームスペース）に属している〇〇（クラスや関数名）と示してくれる

use App\Http\Controllers\Controller;//Controller...他のコントローラークラスの基底となる共通の機能を提供
use App\Providers\RouteServiceProvider;//RouteServiceProvider...ルーティングに関する機能を提供
use App\Models\User;//モデルを使用できる機能を提供　データベース操作
use Illuminate\Foundation\Auth\RegistersUsers;//ユーザー登録に関連する機能を提供
use Illuminate\Support\Facades\Hash;//パスワードのハッシュ化機能を提供
use Illuminate\Support\Facades\Validator;//入力データのバリデーション（正しい形式やルール通りかどうかのチェック）機能を提供
// use...別の場所にある各機能を使うために必要

class RegisterController extends Controller
//RegisterController クラスを定義し、 Controller クラスを継承
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;//新しいユーザーの登録に関連するメソッドや処理を提供

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';//アカウント登録した後にリダイレクトされるURLを指定

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        // $this...現在のインスタンス（redirectTo）のこと
        // middleware...リクエストがルートに到達する前に実行されるメソッド
        // →ログインするときにユーザーがゲスト（ログインしていない）状態かどうかを確認
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    // 登録時の入力データのvalidator（ルール）を定義
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'regex:/^[^\s\u3000]*$/u'], //0424追加
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed', 'regex:/^[^\s\u3000]*$/u'],//0424追加
            ], [
            'name.required' => '名前は必須です。',//0419修正追加
            'email.required' => 'メールアドレスは必須です。',//0419修正追加
            'password.required' => 'パスワードは必須です。',//0419修正追加
            //required...必須項目
            //string...文字列
            //max,min...最大,最小文字数
            //email...メールアドレス（アドレス形式）
            //unique:users...emailがuserテーブル内未登録かどうか
            //confirmed...パスワードと確認用パスワードが一致しているかどうか
            //regex...指定した条件に一致するかどうか
            // ^ と $...文字列の始まりと終わりに対応するために必須
            //\S...半角スペース禁止
            //\u3000...全角スペース禁止
            //u...UTF-8文字を正しく扱うために必要
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    // $dataを引数として受け取る
    {
        return User::create([
        //User::create...Userモデルのcreateメソッドを呼び出して、新しいレコード（ユーザーアカウント）をDBに入れる
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            // Hash...ハッシュ化（パスワードなどのセキュリティ上大事なデータを難読化する）
        ]);

    }
}

// protected: 使用しているクラス内＆サブクラスからアクセス可能
// public: 他のクラスから自由に呼び出せる
// private: 使用しているクラス内でのみ呼び出せる　サブクラスから呼び出せない

// function: 関数（メソッド）の宣言を開始。
// create: メソッドの種類。新しいユーザーを作成する。
// array: createメソッドの引数を配列に指定。$data という名前の配列を受け取る。
// $data: メソッドの引数。新しいユーザーの情報が含まれた配列。（名前、メールアドレス、パスワードなど）
