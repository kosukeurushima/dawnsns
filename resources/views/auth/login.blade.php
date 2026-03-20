@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/style.css')}}">

<div class="auth-bg">
    <div class="auth-wrap">

        <div class="auth-logo">
            <img src="{{ asset('images/icons/main_logo.png')}}" alt="DAWNロゴ">
        </div>

        <div class="auth-subtitle">
            Social Network Service
        </div>

        <div class="auth-card">
            <div class="auth-card-title">
                DAWNのSNSへようこそ
            </div>

            <form method="POST" action="{{route('login')}}">
                @csrf

                <div class="auth-form-group">
                    <label for="email">MailAddress</label>
                    <input
                        id="email"
                        type="email"
                        class="@error('email') is-invalid @enderror"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="email"
                        autofocus
                    >

                    @error('email')
                        <div class="auth-error">
                            {{ $message }}
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
                        autocomplete="current-password"
                    >

                    @error('password')
                        <div class="auth-error">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="auth-button-wrap">
                    <button type="submit" class="auth-btn">
                        LOGIN
                    </button>
                </div>
            </form>

            <div class="auth-link">
                <a href="{{route('register')}}">新規ユーザーの方はこちら</a>
            </div>
        </div>
    </div>
</div>
@endsection
