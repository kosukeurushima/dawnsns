@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/style.css') }}">

<div class="auth-bg">
    <div class="auth-wrap">

        <div class="auth-logo">
            <div class="auth-logo">
                <img src="{{asset('images/icons/main_logo.png') }}" alt="DAWNロゴ">
            </div>
        </div>

        <div class="auth-card">
            <div class="auth-card-title">
                新規ユーザー登録
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="auth-form-group">
                    <label for="name">UserName</label>
                    <input
                        id="name"
                        type="text"
                        class="@error('name') is-invalid @enderror"
                        name="name"
                        value="{{old('name')}}"
                        required
                        autocomplete="name"
                        autofocus
                    >

                    @error('name')
                        <div class="auth-error">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="auth-form-group">
                    <label for="email">MailAddress</label>
                    <input
                        id="email"
                        type="email"
                        class="@error('email') is-invalid @enderror"
                        name="email"
                        value="{{old('email')}}"
                        required
                        autocomplete="email"
                    >

                    @error('email')
                        <div class="auth-error">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="auth-form-group">
                    <label for="password">Password</label>
                    <input
                        id="password"
                        type="password"
                        class="@error('password') is-invalid @enderror"
                        name="password"
                        required
                        autocomplete="new-password"
                    >

                    @error('password')
                        <div class="auth-error">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="auth-form-group">
                    <label for="password-confirm">Password confirm</label>
                    <input
                        id="password-confirm"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                    >
                </div>

                <div class="auth-button-wrap">
                    <button type="submit" class="auth-btn">
                        REGISTER
                    </button>
                </div>
            </form>

            <div class="auth-link">
                <a href="{{route('login')}}">ログイン画面へ戻る</a>
            </div>
        </div>
    </div>
</div>
@endsection
