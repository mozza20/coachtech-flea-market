@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/exhibition.css') }}">
@endsection

@section('content')
<div class="exhibition">
    <div class="img-area">
        <img class="item-img" src="" alt="商品画像">
    </div>
    <div class="detail-area">
        <h2 class="item-name">{{$item['name']}}</h2>
        <p class="item-brand">{{$item['brand']}}</p>
        <p class="item-price">￥<span>{{number_format($item['price'])}}</span>(税込)</p>
        <div class="interaction">
        {{-- <form class="interaction" action="{{route('exhibition')}}" method="POST">
            @scrf --}}
            <div class="good">
                <button class="icon" type="submit">
                    <img class="icon__star" src="{{asset('img/star.png')}}" alt="いいね">
                </button>
                <p class="count">5</p>
            </div>
            <div class="comment">
                <img class="icon" src="{{asset('img/speech-bubble.png')}}" alt="コメント">
                <p class="count">3</p>
            </div>
        </div>
        <button class="payment__button">購入手続きへ</button>
        <div class="item-description">
            <h3>商品説明</h3>
            <p class="description__content">{{$item['description']}}</p>
        </div>
        <div class="item-info">
            <h3>商品の情報</h3>
            <div class="info__content">
                <p class="subtitle">カテゴリー</p>
                <div class="categories">
                    @foreach($item->categories as $category)
                    <p class="each-categories">{{$category->content}}</p>
                    @endforeach
                </div>
            </div>
            <div class="info__content">
                <p class="subtitle">商品の状態</p>
                <p class="condition">{{$item->condition['selection']}}</p>
            </div>
        </div>
        <div class="comment-area">
            <p class="comment__title">コメント<span>3</span></p>
            <div class="comment__user">
                <img class="user-img" src="">
                <p class="user-name">admin</p>
            </div>
            <p class="user-comment">こちらにコメントが入ります。</p>
            <form class="" action="" method="">
                <label class="comment__label">商品へのコメント</label>
                <input class="comment__input" type="textarea">
                <button class="submit__button">コメントを送信する</button>
            </form>
        </div>
    </div>
</div>
@endsection