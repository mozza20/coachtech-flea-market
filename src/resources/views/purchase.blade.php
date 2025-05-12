@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="purchase">
    <div class="product-info">
        <img src="product-img" alt="商品画像">
        <p class="product-name">商品名</p>
        <p class="product-price">￥47,000</p>
    </div>
    <div class="payment">
        <label class="payment__label">支払方法</label>
        <select class="payment__select" type="text">
            <option value="コンビニ払い">コンビニ払い</option>
            <option value="カード払い">カード払い</option>
        </select>
    </div>
    <div class="address">
        <p class="address__label">配送先</p>
        <form action="/purchase/address/:item_id" method="GET">
            <button class="address-edit__btn">変更する</button>
        </form>
        <div class="address__area--default">
            <p class="postcode--default"></p>
            <p class="address--default"></p>
        </div>
    </div>
    <div class="sidebar">
        <form class="" action="" method="POST">
            <table class="payment-info">
                <tr>
                    <td class="">商品代金</td>
                    <td class="">￥47,000</td>
                </tr>
                <tr>
                    <td class="">支払方法</td>
                    <td class="">コンビニ払い</td>
                </tr>
            </table>
        </form>
    </div>
</div>
@endsection