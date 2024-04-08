<!-- <!DOCTYPE html>

<html>
    <head>
    <meta charset='utf-8"'>
    <link rel='stylesheet' href='/css/app.css'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <header>
      <h1 class='page-header'>Laravelを使った投稿機能の実装</h1>
    </header> -->

    @extends('layouts.app')
    @section('content')
    <!-- 詳細はindex.blade.phpに記載 -->

  <div class='container'>
    <h2 class='page-header'>新しく投稿する</h2>
    <!-- ===========機能郡ファザード================= -->
    <!-- Laravelなどのフレームワークには、webサイトを作成する上で欠かせない機能を簡単に実装できるように、 -->
    <!-- 様々なクラスとプロパティ、メソッドが用意されていて、その機能群をまとめてファザードという -->

    {!! Form::open(['url' => 'post/create']) !!}
    <!-- 「Form::open」...HTMLでいう<form>の開始タグのこと。 -->
    <!-- HTMLで書くと<form action = 'post/create'> -->
    <!-- 「urlが 'post/create' となっているところにフォームの値を送る」ように設定している -->

    <div class="mb-3">
      {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'rows' => 5, 'placeholder' => '投稿内容']) !!}
      <!-- 'rows' => 5, 改行用に追加 -->
      <!-- CSRF対策 -->
      <!-- name属性として、乱数テキスト（newPost）が一緒に送信される -->
      <!-- newPost...フォーム送信時にトークンを自動で作り、リクエストと一緒にサーバーに送信してくれる -->
    </div>
    <div class="btn-confirm">
      <button type="submit" class="btn">追加</button>
    </div>

     {!! Form::close() !!}
     <!-- これらのファザードはもともと準備されていたものではないからエラー画面になってしまう -->
     <!-- →正常に表示するために別途導入作業がいる -->
     <!-- ①コマンド「composer require laravelcollective/html」でhtmlコードを省略できるライブラリをインストール -->
     <!-- ②「config」フォルダ（Laravelの各種設定をまとめてるフォルダ）の「app.php」で機能追加の記述をする -->
     <!-- ============================ -->
               <!-- 文字数制限エラー用 -->
      @if(session('error'))
          <div class="alert alert-danger">
              {{ session('error') }}
          </div>
      @endif
  </div>

      @endsection
      <!-- 詳細はindex.blade.phpに記載 -->

    <!-- <footer>
      <small>Laravel@crud.curriculum</small>
    </footer>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

</body>
</html> -->
