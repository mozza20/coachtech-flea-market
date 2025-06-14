@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/address.css') }}">
@endsection

@section('content')
<div class="content">
    <h2 class="content__title">住所の変更</h2>
    <form action="{{route('address.edit')}}" method="POST">
        @csrf
        <div class="form-area">
            <label class="form__label">郵便番号</label>
            <input class="form__input" type="text" name="post_code">
        </div>
        <div class="form-area">
            <label class="form__label">住所</label>
            <input class="form__input" type="text" name="address">
        </div>
        <div class="form-area">
            <label class="form__label">建物名</label>
            <input class="form__input" type="text" name="building">
        </div>
        <button class="form__button">更新する</button>
    </form>
</div>
@endsection