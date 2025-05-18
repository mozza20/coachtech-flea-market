@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="content">
    <h2 class="content__title">会員登録</h2>
    @section('no-nav')
    @endsection
    <div class="register__content">
        <form action="{{route('register')}}" method="POST">
            @csrf
            <div class="form-area">
                <label class="form__label" for="name">ユーザー名</label>
                <input class="form__input" id="name" type="text" name="name" value="{{old('name')}}">
                <p class="form__error-message">
                    @error('name')
                    {{ $message }} 
                    @enderror
                </p>
            </div>
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
                <label class="form__label" for="password">パスワード</label>
                <input class="form__input" id="password" type="password" name="password">
                <p class="form__error-message">
                    @error('password')
                    {{ $message }} 
                    @enderror
                </p>
            </div>
            <div class="form-area">
                <label class="form__label" for="password_confirmation">確認用パスワード</label>
                <input class="form__input" id="password_confirmation" type="password" name="password_confirmation">
                <p class="form__error-message">
                    @error('password')
                    {{ $message }} 
                    @enderror
                </p>
            </div>
            <button class="form__button">登録する</button>
            <a class="under-button__link" href="{{route('auth.login')}}">ログインはこちら</a>
        </form>
    </div>
</div>
@endsection
