@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/top.css') }}">
@endsection

@section('content')
<div class="top">
{{-- 購入完了時のメッセージ --}}
{{-- @if (session('purchase_complete'))
    <div id="purchase-complete-message" style="background-color: #d4edda; padding: 10px; margin: 10px 0;">
        {{ session('purchase_complete') }}
    </div>

    <script>
        setTimeout(function() {
            window.location.href = '/';
        }, 3000);
    </script>
@endif --}}

    <div class="toppage-list" >
        <a class="recommend__button {{ request('tab', 'recommend') === 'recommend' ? 'active' : '' }}" href="{{ route('top', ['tab' => 'recommend', 'keyword'=>request('keyword')]) }}">おすすめ
        <a class="mylist__button {{ request('tab', 'recommend') === 'mylist' ? 'active' : '' }}" href="{{ route('top', ['tab' => 'mylist', 'keyword'=>request('keyword')]) }}">マイリスト</a>
    </div>
    <div class="item-list">
        @foreach($items as $item)
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