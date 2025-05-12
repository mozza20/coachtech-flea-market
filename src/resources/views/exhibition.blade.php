@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/exhibition.css') }}">
@endsection

@section('content')
<div class="exhibition">
    <img src="product-img" alt="商品画像">
    <div class="product-detail">
        <h2 class="">商品名</h2>
        <p class="">ブランド名</p>
        <p class="">価格<span>(税込)</span></p>
        <button class="">購入手続きへ</button>
        <div class="">
            <h3 class="">商品説明</h3>
            <p class=""></p>
        </div>
        <div class="">
            <h3 class="">商品の情報</h3>
            <div class=""></div>
                <p class="">カテゴリー</p>
                <p class=""></p>
            </div>
            <div class="">商品の状態</div>
                <p class=""></p>
                <p class=""></p>
            </div>
        </div>
        <div class="comments-area">
            <div class="">
            <img class="each-user-icon" src="">
            <p class="each-user-name">admin</p>
                <p class="each-comment">こちらにコメントが入ります。</p>
            </div>
            <form class="" action="">
                <label class="">商品へのコメント</label>
                <input class="" type="textarea">
                <button class="">コメントを送信する</button>
            </form>
        </div>
    </div>
</div>
@endsection