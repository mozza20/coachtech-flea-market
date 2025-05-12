@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/top.css') }}">
@endsection

@section('content')
<div class="top">
    <div class="toppage-list">
        <p class="">おすすめ</p>
        <p class="">マイリスト</p>
    </div>
    <div class="products-row">
        {{-- @foreach('') --}}
        <a href="/item/:item_id">
            <div class="">
                <img class="products-img" src="" alt="商品画像">
                <p class="products-name"></p>
            </div>
        </a>
        {{-- @endforeach --}}
    </div>

</div>
@endsection