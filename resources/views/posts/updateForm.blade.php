@extends('layouts.app')
    @section('content')
    <!-- 詳細はindex.blade.phpに記載 -->

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

        <div class="alert"> <!-- 0419修正追加 -->
            <!-- 空白エラー表示 -->
            @error('upPost')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <!-- 文字数制限エラー表示 -->
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
        </div>

    </div>
    <!-- 詳細はindex.blade.phpに記載 -->
@endsection
