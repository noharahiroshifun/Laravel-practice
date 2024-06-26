@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-header">{{ __('ログイン') }}</div>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="input-box">
                    <label for="email" class="col-md-4">{{ __('メールアドレス') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>
                </div>

                <div class="input-box">
                    <label for="password" class="col-md-4">{{ __('パスワード') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    </div>
                </div>

                <div class="mb-login-ret">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('ログイン状態を保持する') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="btn-confirm">
                    <button type="submit" class="btn btn-login">
                        {{ __('ログイン') }}
                    </button>
                    <!-- <div class="col-md-8 offset-md-4"> -->
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

                <!-- @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('パスワードをお忘れの方はこちら') }}
                    </a>
                @endif -->

            </form>
        </div>
    </div>
</div>
@endsection
