<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"><!-- 言語設定 -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- meta...ビューポートの設定 -->
    <!-- width=device-width...ビューポートの幅をデバイスの幅に設定。
         initial-scale=1...初期のズームレベルを1に設定。これによってレスポンシブデザインが可能になる。 -->

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSRF Token（csrf攻撃を防ぐために記載） -->
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- app.name...ファイル名（Laravel）の指定。指定がない場合、''内の名前を使用 -->

    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- assetで指定したJavascriptファイルの読み込み。 -->
    <!-- defer...ページの解析が完全に終了してからスクリプトを実行するように指定。
    これがないと非同期で非同期でダウンロードされるため、読み込み時に遅延が起きてユーザーが待たされる可能性がある -->

    <!-- 虫眼鏡(font awesome)用 -->
    <link href="https://use.fontawesome.com/releases/v6.4.0/css/all.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>


<body>
    <header>
        <div class="BBS-box">
            <h1>BBS.TOWN</h1>
            <!-- あいまい検索機能 -->
          <form class="search-box" action="/search" method="GET">
            <!-- searchに指定 -->
              <div class="form-group">
                  <!-- <input type="text" class="form-control" name="search_content" placeholder="投稿内容で検索"> -->
                  <input type="text" class="form-search" name="search_content" placeholder="投稿内容で検索">
                    <button type="submit fa" value="&#xf002;" class=" btn-primary"><i class="fa fa-search"></i></button>
              </div>
          </form>

            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="navbar-wrapper">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <!-- <ul class="navbar-nav me-auto"></ul> -->

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest<!-- ログインしていない時に以下のコードを実行 -->
                            @if (Route::has('login')) <!-- web.php内に'login'ルートがある場合、以下のコードを実行 -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                                    <!-- ログインリンクを表示 -->
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('新規登録') }}</a>
                                    <!-- 新規登録リンクを表示 -->
                                </li>
                            @endif
                            <!-- 「{」...XSS対策。自動でPHPのhtmlspecialchars関数を通してくれる -->
                            <!-- [__]アンダーバー２本...他言語に対応するために記述 -->
                            <!-- route('')...（）内のURLを生成 -->
                            <!-- __('')...ログインリンクの表示名 -->
                            @else
                           <!-- ログインしている時に以下のコードを実行 -->
                            <li class="nav-item dropdown">

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault();
                                        // route('logout'...ルーディングでログアウト処理にlogoutと名前をつけたため、
                                        // route('logout')と指定することでログアウト後にログインページへリダイレクトできる
                                        // event.preventDefault()...通常行う動作のキャンセル　→ページ遷移をせずにログアウト処理ができる
                                       document.getElementById('logout-form').submit();">
                                       <!-- getElementById...()内のフォームidを取得 ※aタグのすぐ下にある処理内容 -->
                                       <!-- submit()...取得したフォームを自動で送信 -->
                                        {{ __('ログアウト') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                                        @csrf
                                        <!-- csrf攻撃対策 -->
                                        <!-- フォームに正しいCSRFトークンが入っていないとリクエストが失敗される -->
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        </div>
    </header>
    <div id="app">
            @yield('content')
    </div>

    <footer>
        <small>Laravel@crud.curriculum</small>
    </footer>
</body>
</html>
