@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage">
    <div class="user-info__area">
        <div class="user-info">
            <div class="user-img__area">
                <img class="user-img" src="" alt="">
            </div>
            <h2 cass="user-name">{{$user->name}}</h2>
        </div>    
        <form class="prof-edit__form" action="{{route('profile')}}" method="GET">
            <button class="prof-edit__btn">プロフィールを編集</button>
        </form>
    </div>
    
    <div class="mypage-list">
        <p class="">出品した商品</p>
        <p class="">購入した商品</p>
    </div>

    <div class="item-list">
    @foreach($items as $item)
        <div class="item">
            <img class="item-img" src="{{asset('storage/'.$item->img_url)}}" alt="商品画像">
            <p class="item-name">{{$item->name}}</p>
        </div>
        @endforeach
    </div>

</div>
@endsection