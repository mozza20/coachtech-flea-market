@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/exhibition.css') }}">
@endsection

@section('content')
<div class="exhibition">
    <img src="item-img" alt="商品画像">
    <div class="item-detail">
        <h2 class="">{{$item->name}}</h2>
        <p class="">{{$item['brand']}}</p>
        <p class="">{{$item['price']}}<span>(税込)</span></p>
        <button class="">購入手続きへ</button>
        <div class="">
            <h3 class="">商品説明</h3>
            <p class="">{{$item['description']}}</p>
        </div>
        <div class="">
            <h3 class="">商品の情報</h3>
            <div class=""></div>
                <p class="">カテゴリー</p>
                @foreach($item->categories as $category)
                <p class="">{{$category->content}}</p>
                @endforeach
            </div>
            <div class="">
                <p class="">商品の状態</p>
                <p class="">{{$item['condition_id']}}</p>
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