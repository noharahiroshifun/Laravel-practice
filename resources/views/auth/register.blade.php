@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('新規アカウント登録') }}</div>

                <div class="card-body">
                    <!-- <form method="POST" action="{{ route('register') }}"> -->
                        <!-- フォーム送信後にログイン画面へ遷移するように下記に変更 -->
                    <form method="POST" action="{{ route('login') }}">

                        @csrf

                        <div class="input-box">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('お名前') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            </div>
                        </div>

                        <div class="input-box">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('メールアドレス') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>
                        </div>

                        <div class="input-box">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('パスワード') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="input-box">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('パスワード確認用') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="reg btn-confirm">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-register">
                                    {{ __('新規アカウント登録') }}
                                </button>
                            </div>
                        </div>
                        <div class="alert">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                               <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                             @error('password')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
