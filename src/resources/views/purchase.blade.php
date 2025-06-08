@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="purchase">
    <div class="product-info">
        <img class="product-img" src="" alt="商品画像">
        <div class="product-info__text">
            <h2 class="product-name">{{$item['name']}}</h2>
            <p class="product-price"><span>￥</span>{{number_format($item['price'])}}</p>
        </div>
    </div>
    <form class="" action="{{ route('purchase.complete', ['item_id' => $item->id]) }}" method="POST">
        @csrf
        <div class="payment">
            <label class="payment__label">支払い方法</label>
            <select class="payment__method" type="text" name="payment" id="payment" onchange="updatePaymentDisplay()">
                <option value="" selected hidden>選択してください</option>
                <option value="コンビニ払い">コンビニ払い</option>
                <option value="カード払い">カード払い</option>
            </select>
            <div class="form__error-message">
                @error('payment')
                {{$message}}
                @enderror
            </div>
        </div>
        <div class="address">
            <p class="address__label">配送先</p>
            <a class="address-edit__link">変更する</a>
            <div class="address__area--default">
                <p><span>〒</span>{{$user->post_code}}</p>
                <p>{{$user->address}}</p>
            </div>
        </div>
        <div class="sidebar">
            <table class="payment__table">
                <tr class="payment__table--row">
                    <td class="table__label">商品代金</td>
                    <td class="table__data"><span>￥ </span>{{number_format($item['price'])}}</td>
                </tr>
                <tr>
                    <td class="table__label">支払い方法</td>
                    <td class="table__data" id="payment-display"></td>
                    <!-- JavaScript -->
                    <script>
                        function updatePaymentDisplay() {
                            const select = document.getElementById('payment');
                            const display = document.getElementById('payment-display');
                            display.textContent = select.value;
                        }
                    </script>
                </tr>
            </table>
            <button class="form__button" type="submit">購入する</button>
        </div>
    </form>

</div>
@endsection