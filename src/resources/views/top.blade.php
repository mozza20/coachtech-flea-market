@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/top.css') }}">
@endsection

@section('content')
<div class="top">
    <div class="toppage-list">
        <p class="list1">おすすめ</p>
        <p class="list2">マイリスト</p>
    </div>
    <div class="products-lists">
        {{-- @foreach('items') --}}
        <a href="/item/:item_id">
            <div class="products">
                <img class="products-img" src="{{ asset('storage/product-img/product_Armani_Mens_Clock.jpg') }}" alt="商品画像">
                <p class="products-name">商品名</p>
            </div>
        </a>
        {{-- @endforeach --}}
        {{-- @foreach('items') --}}
        <a href="/item/:item_id">
            <div class="products">
                <img class="products-img" src="{{ asset('storage/product-img/product_Armani_Mens_Clock.jpg') }}" alt="商品画像">
                <p class="products-name">商品名</p>
            </div>
        </a>
        {{-- @endforeach --}}
        {{-- @foreach('items') --}}
        <a href="/item/:item_id">
            <div class="products">
                <img class="products-img" src="{{ asset('storage/product-img/product_Armani_Mens_Clock.jpg') }}" alt="商品画像">
                <p class="products-name">商品名</p>
            </div>
        </a>
        {{-- @endforeach --}}
    </div>

</div>
@endsection