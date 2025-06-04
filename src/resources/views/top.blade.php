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
    <div class="item-list">
        @foreach($items as $item)
         {{-- @foreach以下は１つに。自分の出品した製品は表示しない--}}
        <a class="item" href="/item/{{$item->id}}">
            <img class="item-img" src="{{$item->img_url}}" alt="商品画像">
            <p class="item-name">{{$item->name}}</p>
        </a>
        @endforeach
        @foreach($items as $item)
        <a class="item" href="/item/{{$item->id}}">
            <img class="item-img" src="{{$item->img_url}}" alt="商品画像">
            <p class="item-name">{{$item->name}}</p>
        </a>
        @endforeach
        @foreach($items as $item)
        <a class="item" href="/item/{{$item->id}}">
            <img class="item-img" src="{{$item->img_url}}" alt="商品画像">
            <p class="item-name">{{$item->name}}</p>
        </a>
        @endforeach
    </div>

</div>
@endsection