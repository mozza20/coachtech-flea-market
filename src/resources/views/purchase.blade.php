@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="purchase">
    {{-- 購入キャンセルのとき --}}
@if(isset($message))
    <p class="form__error-message">{{ $message }}</p>
@endif
    <div class="product-info">
        <img class="product-img" src="{{asset('storage/'.$item->img_url)}}" alt="商品画像">
        <div class="product-info__text">
            <h2 class="product-name">{{$item['name']}}</h2>
            <p class="product-price"><span>￥</span>{{number_format($item['price'])}}</p>
        </div>
    </div>
    <form action="{{ route('checkout', ['item_id' => $item->id]) }}" method="POST">
        @csrf --

        <div class="payment">
            <input type="hidden" name="item_id" value="{{ $item->id }}">
            <label class="payment__label">支払い方法</label>
            <select class="payment__method" type="text" name="payment" id="payment" onchange="updatePaymentDisplay()">
                <option value="" selected hidden {{ old('payment') ? '' : 'selected' }}>選択してください</option>
                <option value="コンビニ払い"  {{ old('payment') == 'コンビニ払い' ? 'selected' : '' }}>コンビニ払い</option>
                <option value="カード払い" {{ old('payment') == 'カード払い' ? 'selected' : '' }}>カード払い</option>
            </select>
            <div class="form__error-message">
                @error('payment')
                {{$message}}
                @enderror
            </div>
        </div>
        <div class="address">
            <p class="address__label">配送先</p>
            <a class="address-edit__link" href="{{ route('purchase.address', ['item_id' => $item->id]) }}">変更する</a>
            <div class="address__area">
                @if($address)
                    <p><span>〒</span>{{$address->post_code}}</p>
                    <p>{{$address->address}}</p>
                    <p>{{$address->building}}</p>
                @else
                    <p><span>〒</span>{{$user->post_code}}</p>
                    <p>{{$user->address}}</p>
                    <p>{{$user->building}}</p>
                @endif
                <div class="form__error-message">
                    @error('address')
                    {{$message}}
                    @enderror
                </div>
            </div>
            
        </div>
        <div class="sidebar">
            <table class="payment__table">
                <tr class="payment__table--row">
                    <td class="table__label">商品代金</td>
                    <td class="table__data"><span>￥ </span>{{number_format($item['price'])}}</td>
                </tr>
                <tr class="payment__table--row">
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