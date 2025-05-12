@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
<div class="sell">
    <h2 class="sell__ttl">商品の出品</h2>
    <form class="" action="POST" enctype="multipart/form-data">
        @csrf
        <div class="product__img-area">
            <input class="product__img" type="file" name="user_img" accept="image/*">
        </div>
        <div class="product__detail-area">
            <h3 class="detail__ttl">商品の詳細</h3>
            <input class="detail__categories" type="radio" name="category_id"></input>
            <select class="detail__condition" name="condition_id">
                <option value="">選択してください</option>
                <option value=""></option>
            </select>
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
    </form>
</div>
@endsection