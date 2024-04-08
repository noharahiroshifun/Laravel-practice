<!-- index.blade.php -->

<!-- Lesson13のあいまい検索機能参考 -->


<!-- <!DOCTYPE html>

<html>
    <head>
      <meta charset='utf-8"'>
      <link rel='stylesheet' href="{{ asset('/css/app.css') }}">
      <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

      <body>
        <header>
          <h1>Laravelを使った投稿機能の実装</h1>
        </header> -->

        <!-- ＝＝＝＝＝上記はディレクティブによって削除＝＝＝＝＝ -->
        @extends('layouts.app')
        <!-- ＝＝＝＝＝＝＝代わりに下記１行を追加＝＝＝＝＝＝＝＝ -->

        <!-- app.blade.phpが親となり、index.blade.phpが子となる。 -->
        <!-- 「('app')」の部分がファイル名を指定 -->
        <!-- 「resource/views」の直下を起点に、どの「○○.blade.php」のファイルを読み込むかを指定 -->
        <!-- 例）app.blade.phpファイルが「resource/views/posts」の中に入っていたら、「('posts.app')」と記述することで読み込める -->

        <!-- authのコマンドで制作されたlayoutsフォルダの中の「app.blade.php」へと指定を変更 -->


        <!-- sectionで囲う「index.blade.php」にあるコードが、app.blade.phpから見てどの位置に配置するか決める -->
        @section('content')


        <div class='container'>
            <!-- 下記１行createの実装用に追加 -->

          <h2 class='page-header'>投稿一覧</h2>




              <!-- 投稿リストページの中で最も重要となる投稿一覧を実装している箇所 -->
              @foreach ($lists as $list)


                  <!-- マイグレーションで作成したカラムと揃える -->
                  <div class=list-box>

                    <div class=list-content>
                      <div class=content-title>投稿内容

                      </div>
                      <!-- 投稿内容に改行を表示するためにnl2br関数を使用 -->
                      <div class="content-copy" style="word-wrap: break-word;">{!! nl2br(e($list->contents)) !!}</div>
                    </div>


                    <div class="list-info">
                      <div class=info-name>
                        <div class=c-name-t>投稿者名</div>
                        <div class=c-name>{{ $list->user_name }}</div>
                      </div>

                      <div class=info-time>
                        <div class=c-time-t>投稿日時</div>
                        <div class=c-time>{{ $list->created_at }}</div>
                      </div>

                      <!-- UPDATE用(更新ボタン用) -->
                      <div class=btn-box>
                        <div class=btn-update-box>
                          <a class=btn-update href="/post/{{ $list->id }}/update-form">更新</a>
                        </div>
                        <!-- <a>タグのhref属性に各投稿のidカラムの値が書き出されるように設置 -->
                        <!-- HTTPの通信方法をGETにして、URLにパラメータを一緒に送れるように -->
                        <!-- DELETE用に追加 -->
                        <div>
                          <a class=btn-delete href="/post/{{ $list->id }}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</a>
                        </div>
                      </div>
                    </div>

                  </div>

              @endforeach


              <!-- あいまい検索でヒットしない時にエラーメッセージ表示 -->
              @if (isset($message))
                <p>{{ $message }}</p> <!-- 修正箇所 -->
              @endif

            <p class="fixed-pull-right">
              <a class="btn-create" href="/create-form">
                <i class="fa-regular fa-pen-to-square"></i>
              </a>
            </p>
        </div>
          @endsection

          <!-- ＝＝＝＝＝下記はディレクティブによって削除＝＝＝＝＝ -->
          <!-- <footer>
            <small>Laravel@crud.curriculum</small>
          </footer>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      </body>
</html> -->
