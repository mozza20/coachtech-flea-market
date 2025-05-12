@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login">
    <div clsss="login__title">
        会員登録
    </div>
    @section('no-nav')
    @endsection
    <div clsss="login__content">
        <form action="login__form">
            <div class="form-area">
                <label class="">メールアドレス</label>
                <input class="" type="email">
            </div>
            <div class="form-area">
                <label class="">パスワード</label>
                <input class="" type="password">
            </div>
            <button class="login__button">ログインする</button>
            <a class="link--register" href="/login">会員登録はこちら</a>
        </form>
    </div>
</div>
@endsection
