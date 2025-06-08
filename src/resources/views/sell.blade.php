@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
<div class="content">
    <h2 class="content__title">商品の出品</h2>
    <form class="product-form" action="{{route('product.sell')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-area">
            <label class="form__label">商品画像</label>
            <div class="product-img__area">
                <input class="product-img" type="file" name="img_url" accept="image/*">
            </div>
            <div class="form__error-message">
                @error('img_url')
                {{$message}}
                @enderror
            </div>
        </div>
        <div class="product-info__area">
            <h3 class="info__title">商品の詳細</h3>
            <div class="form-area">
                <label class="form__label">カテゴリー</label>
                <div class="form__checkboxs">
                    @foreach($categories as $category)
                    <label class="info__label--categories">
                        <input class="info__input--categories" type="checkbox" name="category_ids[]" value="{{$category['id']}}">
                        <span>{{$category['content']}}</span>
                    </label>
                    @endforeach
                </div>
                <div class="form__error-message">
                    @error('category_ids')
                    {{$message}}
                    @enderror
                </div>
            </div>
            <div class="form-area">
                <label class="form__label">商品の状態</label>
                <select class="info--condition" name="condition_id">
                    <option value="" selected hidden>選択してください</option>
                    @foreach($conditions as $condition)
                    <option value="{{$condition['id']}}">{{$condition['selection']}}</option>
                    @endforeach
                </select>
                <div class="form__error-message">
                    @error('condition_id')
                    {{$message}}
                    @enderror
                </div>
            </div>

            <h3 class="info__title">商品名と説明</h3>
            <div class="form-area">
                <label class="form__label">商品名</label>
                <input class="form__input" type="text" name="name" value="{{old('name')}}">
                <div class="form__error-message">
                    @error('name')
                    {{$message}}
                    @enderror
                </div>
            </div>
            <div class="form-area">
                <label class="form__label">ブランド名</label>
                <input class="form__input" type="text" name="brand" value="{{old('brand')}}">
            </div>
            <div class="form-area">
                <label class="form__label">商品の説明</label>
                <textarea class="form__textarea" name="description"> {{old('description')}}</textarea>
                <div class="form__error-message">
                    @error('description')
                    {{$message}}
                    @enderror
                </div>
            </div>
            <div class="form-area">
                <label class="form__label">販売価格</label>
                <div class="price-group">
                    <span class="yen-symbol">￥</span>
                    <input class="form__input" type="number" name="price" value="{{old('price')}}">
                    <div class="form__error-message">
                        @error('price')
                        {{$message}}
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <button class="form__button" type="submit">出品する</button>
    </form>
</div>
@endsection