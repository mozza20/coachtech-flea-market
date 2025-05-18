@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="content">
    <h2 class="content__title">ログイン</h2>
    @section('no-nav')
    @endsection
    <div class="login__content">
        <form action="{{route('login')}}" method="POST">
            @csrf
            <div class="form-area">
                <label class="form__label" for="email">メールアドレス</label>
                <input class="form__input" id="email" type="text" name="email" value="{{old('email')}}">
                <p class="form__error-message">
                    @error('email')
                    {{ $message }} 
                    @enderror
                </p>
            </div>
            <div class="form-area">
                <label class="form__label">パスワード</label>
                <input class="form__input" type="password" name="password">
                <p class="form__error-message">
                    @error('password')
                    {{ $message }} 
                    @enderror
                </p>
            </div>
            <button class="form__button">ログインする</button>
            <a class="under-button__link" href="{{route('auth.register')}}">会員登録はこちら</a>
        </form>
    </div>
</div>
@endsection
