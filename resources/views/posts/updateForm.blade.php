<!-- updateForm.blade.php -->
<!-- フォームに値を入れ、編集ができるようにpostsフォルダ内にビューファイルを作成 -->

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


<!-- 下記に変更kakinihennkou -->

<div class='container'>
    <h2 class='page-header'>投稿内容を変更する</h2>

    {!! Form::open(['url' => '/post/update']) !!}
    <div class="update-input-box">
        {!! Form::hidden('id', $post->id) !!}
        {!! Form::input('text', 'upPost', $post->contents, ['required', 'class' => 'form-control']) !!}
    </div>
    <div class="btn-confirm">
       <button type="submit" class="btn ">更新する</button>
    </div>

    {!! Form::close() !!}

        <!-- エラーメッセージがあれば表示 -->
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
</div>


<!-- 詳細はindex.blade.phpに記載 -->

<!-- <footer>
  <small>Laravel@crud.curriculum</small>
</footer>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

</body>
</html> -->
    @endsection
