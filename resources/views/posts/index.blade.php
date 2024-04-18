<!-- ＝＝＝＝＝ディレクティブによって上部削除＝＝＝＝＝ -->
@extends('layouts.app')
<!-- ＝＝＝＝＝＝＝代わりに下記１行を追加＝＝＝＝＝＝＝＝ -->
@section('content')

<!-- app.blade.phpが親となり、index.blade.phpが子となる。 -->
<!-- 「('app')」の部分がファイル名を指定 -->
<!-- 「resource/views」の直下を起点に、どの「○○.blade.php」のファイルを読み込むかを指定 -->
<!-- 例）app.blade.phpファイルが「resource/views/posts」の中に入っていたら、「('posts.app')」と記述することで読み込める -->

<!-- authのコマンドで制作されたlayoutsフォルダの中の「app.blade.php」へと指定を変更 -->


<!-- sectionで囲う「index.blade.php」にあるコードが、app.blade.phpから見てどの位置に配置するか決める -->



<div class='container'>
    <!-- 投稿一覧エリア -->
  <h2 class='page-header'>投稿一覧</h2>

      @foreach ($lists as $list)
          <!-- マイグレーションで作成したカラムと揃える -->
          <div class=list-box>

            <div class=list-content>
              <div class=content-title>投稿内容</div>
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
              @if(auth()->check() && $list->user_name === auth()->user()->name)
                <!-- ログインしているユーザーが投稿した投稿のみ更新・削除ボタンを表示 -->

                <!-- ボタンエリア -->
                <div class=btn-box>
                  <!-- 更新ボタン-->
                  <div class=btn-update-box>
                    <a class=btn-update href="/post/{{ $list->id }}/update-form">更新</a>
                    <!-- <a>タグのhref属性に各投稿のidカラムの値が書き出されるように設置 -->
                    <!-- HTTPの通信方法をGETにして、URLにパラメータを一緒に送れるように -->
                  </div>

                  <!-- 削除ボタン -->
                  <div>
                    <a class=btn-delete href="/post/{{ $list->id }}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</a>
                    <!-- onclick...削除ボタンを押した時に実行されるJavaScript -->
                    <!-- return...この後に続く関数の結果を返す -->
                    <!-- confirm...はい。かいいえ。の確認ポップアップの表示 -->
                  </div>
                </div>
              @endif
            </div>

          </div>
      @endforeach

      <!-- あいまい検索でヒットしない時にエラーメッセージ表示 -->
      @if (isset($message))
        <p>{{ $message }}</p>
        <!-- PostsController.phpあいまい検索箇所のエラー文参照 -->
      @endif

    <p class="fixed-pull-right">
      <a class="btn-create" href="/create-form">
        <i class="fa-regular fa-pen-to-square"></i>
      </a>
    </p>
</div>
  @endsection
