@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="profile">
    <h2 class="profile__ttl">プロフィール設定</h2>
    <form class="prof-edit__form" action="" method="POST">
        @csrf
        <div class="prof-img__area">
            <img class="user-img" src="" alt="">
            <button class="user-img--edit">画像を選択する</button>
        </div>
        <div class="prof-edit__group">
            <label class="">ユーザー名</label>
            <input class="" type="text" placeholder="既存の値が入力されている">
        </div>
        <div class="prof-edit__group">
            <label class="">郵便番号</label>
            <input class="" type="text" placeholder="既存の値が入力されている">
        </div>
        <div class="prof-edit__group">
            <label class="">住所</label>
            <input class="" type="text" placeholder="既存の値が入力されている">
        </div>
        <div class="prof-edit__group">
            <label class="">建物名</label>
            <input class="" type="text" placeholder="既存の値が入力されている">
        </div>
        <button class="prof-update__btn">更新する</button>
    </form>
</div>
@endsection