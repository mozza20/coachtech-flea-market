@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
<div class="content">
    <h2 class="content__title">商品の出品</h2>
    <form class="product-form" action="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-area">
            <label class="form__label">商品画像</label>
            <div class="product-img__area">
                <input class="product-img" type="file" name="poduct_img" accept="image/*">
            </div>
        </div>
        <div class="product-info__area">
            <h3 class="info__title">商品の詳細</h3>
            <input class="info__categories" type="radio" name="category_id">
            <div class="form-area">
                <label class="form__label">商品の状態</label>
                <select class="info__condition" name="condition_id">
                    <option value="">選択してください</option>
                    <option value=""></option>
                </select>
            </div>
        </div>
        <div class="product-info__area">
            <h3 class="info__title">商品名と説明</h3>
            <div class="form-area">
                <label class="form__label">商品名</label>
                <input class="form__input" type="text" name="name">
            </div>
            <div class="form-area">
                <label class="form__label">ブランド名</label>
                <input class="form__input" type="text" name="brand">
            </div>
            <div class="form-area">
                <label class="form__label">商品の説明</label>
                <input class="form__input" type="text" name="description">
            </div>
            <div class="form-area">
                <label class="form__label">販売価格</label>
                <input class="form__input" type="text" name="price">
            </div>
        </div>
        <button class="form__button">出品する</button>
    </form>
</div>
@endsection