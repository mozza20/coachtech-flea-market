@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage">
    <div class="user-info__area">
        <div class="user-info">
            <div class="user-img__area">
                <img class="user-img" src="" alt="">
            </div>
            <h2 cass="user-name">ユーザー名</h2>
        </div>    
        <form class="prof-edit__form" action="{{route('profile')}}" method="GET">
            <button class="prof-edit__btn">プロフィールを編集</button>
        </form>
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