@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection



@section('content')
<div class="register">
    <div clsss="register__title">
        会員登録
    </div>
    @section('no-nav')
    @endsection
    <div clsss="register__content">
        <form class="register__form" action="/" method="POST">
            @csrf
            <div class="form-area">
                <label class="">ユーザー名</label>
                <input class="" type="text" name="name">
            </div>
            <div class="form-area">
                <label class="">メールアドレス</label>
                <input class="" type="email" name="email">
            </div>
            <div class="form-area">
                <label class="">パスワード</label>
                <input class="" type="password" name="password">
            </div>
            <div class="form-area">
                <label class="">確認用パスワード</label>
                <input class="" type="password" name="password_confirmation">
            </div>
            <button class="register__button">登録する</button>
            <a class="link--login" href="/login">ログインはこちら</a>
        </form>
    </div>
</div>
@endsection
