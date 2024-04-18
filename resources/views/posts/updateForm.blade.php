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

        <!-- エラーメッセージがあれば表示 -->
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>
    <!-- 詳細はindex.blade.phpに記載 -->
@endsection
