@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/address.css') }}">
@endsection

@section('content')
<div class="address">
    <h2 class="address-edt__ttl">住所の変更</h2>
    <form class="" action="" method="POST">
        @csrf
        <div class="address-edit__group">
            <label class="">郵便番号</label>
            <input class="" type="text">
        </div>
        <div class="address-edit__group">
            <label class="">住所</label>
            <input class="" type="text">
        </div>
        <div class="address-edit__group">
            <label class="">建物名</label>
            <input class="" type="text">
        </div>
        <button class="address-update__btn">更新する</button>
    </form>
</div>
@endsection