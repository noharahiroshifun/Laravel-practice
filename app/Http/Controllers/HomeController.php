<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('Login');
        //home→Loginに変更
    }
}

// =============================================
//  public function メソッド ()の「()」箇所に関して
// =============================================
// この関数が、引数を受け取る場合に()内に受け取りたい引数を設定
// 常に同じ画面を表示する場合は引数不要
// 今回の場合、アカウントによって表示や機能が変わる際に引数を入れる
