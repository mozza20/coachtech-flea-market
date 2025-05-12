@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage">
    <div class="user-info">
        <img class="user-img" src="" alt="">
        <h2 cass="user-name">ユーザー名</h2>
        <button class="prof-edit__btn">プロフィールを編集</button>
    </div>
    <div class="mypage-list">
        <p class="">出品した商品</p>
        <p class="">購入した商品</p>
    </div>
    <div class="products-data">
        <img class="product-img" src="" alt="">
        <img class="product-img" src="" alt="">
        <img class="product-img" src="" alt="">
        <img class="product-img" src="" alt="">
    </div>
</div>
@endsection