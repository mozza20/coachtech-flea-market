@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/address.css') }}">
@endsection

@section('content')
<div class="content">
    <h2 class="content__title">住所の変更</h2>
    <form action="{{route('address.edit', ['item_id' => $item->id])}}" method="POST">
        @csrf
        <div class="form-area">
            <label class="form__label">郵便番号</label>
            <input class="form__input" type="text" name="post_code" value="{{old('post_code')}}">
            <p class="form__error-message">
                @error('post_code')
                {{ $message }} 
                @enderror
            </p>
        </div>
        <div class="form-area">
            <label class="form__label">住所</label>
            <input class="form__input" type="text" name="address" value="{{old('address')}}">
            <p class="form__error-message">
                @error('address')
                {{ $message }} 
                @enderror
            </p>
        </div>
        <div class="form-area">
            <label class="form__label">建物名</label>
            <input class="form__input" type="text" name="building" value="{{old('building')}}">
            <p class="form__error-message">
                @error('building')
                {{ $message }} 
                @enderror
            </p>
        </div>
        <button class="form__button" type="submit">更新する</button>
    </form>
</div>
@endsection