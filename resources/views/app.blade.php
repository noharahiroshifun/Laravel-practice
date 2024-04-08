<!-- フロントの共通化
各ページの共通部分（主にヘッダーフッダー） -->
<!-- Laravelにおいて「@extends」と「@section / @yield」を活用 -->
<!-- ＠で始まる機能をディレクティブと呼ぶ -->

<!DOCTYPE html>
<html>

<head>
<meta charset='utf-8'>
<link rel='stylesheet' href='/css/app.css'>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<header>
  <h1 class='page-header'>BBS.TOWN</h1>
</header>

@yield('content')
<!-- ここに他ファイルにある「@section('content')」と「@endsection」の内側にあるコードが反映される -->

<footer>
  <small>Laravel@crud.curriculum</small>
</footer>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

</body>
</html>
<!-- 他ファイルにある同じ記載内容は削除 -->
