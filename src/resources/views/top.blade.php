@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/top.css') }}">
@endsection

@section('content')
<div class="top">
{{-- 購入完了時のメッセージ --}}
@if (session('purchase_complete'))
    <div id="purchase-complete-message" style="background-color: #d4edda; padding: 10px; margin: 10px 0;">
        {{ session('purchase_complete') }}
    </div>

    <script>
        setTimeout(function() {
            window.location.href = '/';
        }, 3000);
    </script>
@endif

    <div class="toppage-list" >
        <a class="recommend__button" href="{{ route('top') }}">おすすめ
        <a class="mylist__button" href="{{ route('top', ['tab' => 'mylist']) }}">マイリスト</a>
    </div>
    <div class="item-list">
        @foreach($items as $item)
         {{-- @foreach以下は1つに。自分の出品した製品は表示しない--}}
        <a class="item" href="/item/{{$item->id}}">
            <img class="item-img" src="{{asset('storage/'.$item->img_url)}}" alt="商品画像">
            @if($item->status==='sold')
                <p class="sold">sold</p>
            @endif
            <p class="item-name">{{$item->name}}</p>
        </a>
        @endforeach
    </div>

</div>
@endsection