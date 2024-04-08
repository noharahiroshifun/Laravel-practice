<?php

namespace App\Http\Controllers\Auth;
// RegisterControllerクラスがApp\Http\Controllers\Authという名前空間に属していることを示している
// 名前が被ってしまうことを防ぐ

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
// use文 b...他のファイルにあるクラスを使える様にする


class RegisterController extends Controller
// RegisterControllerクラスを宣言
// 新規アカウント登録に関わる処理用
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

    use RegistersUsers;//RegistersUsersクラスを使用。新規アカウント登録に関する一連の機能を提供するためのクラス

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';
    // 新規アカウント登録後にリダイレクトする先のURLを指定



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() //コンストラクタ
    {
        $this->middleware('guest');
    }
    //インスタンスが作られるたびに自動で実行
    // guest...ログインしていないユーザーのみアクセスできる設定



    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }
    // validatorメソッド...入力データが作ったルールに従っているかをチェック



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    protected function create(array $data)
    {
    return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
    ]);
    }
    // create...新規アカウントをデータベースに登録するためのメソッド

}
