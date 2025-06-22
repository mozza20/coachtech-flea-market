@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="content">
    <h2 class="content__title">プロフィール設定</h2>
    <form class="prof-edit__form" action="{{route('update')}}" method="POST">
        @method('PATCH')
        @csrf
        <div class="prof-img__area">
            <div class="user-img__area">
                <img class="user-img" src="" alt="">
            </div>
            <button class="user-img--edit">画像を選択する</button>
        </div>
        <div class="form-area">
            <label class="form__label">ユーザー名</label>
            <input class="form__input" type="text" name="name" value="{{$user->name}}">
            <p class="form__error-message">
                @error('name')
                {{ $message }} 
                @enderror
            </p>
        </div>
        <div class="form-area">
            <label class="form__label">郵便番号</label>
            <input class="form__input" type="text" name="post_code" value="{{$user->post_code}}">
            <p class="form__error-message">
                @error('post_code')
                {{ $message }} 
                @enderror
            </p>
        </div>
        <div class="form-area">
            <label class="form__label">住所</label>
            <input class="form__input" type="text" name="address" value="{{$user->address}}">
            <p class="form__error-message">
                @error('address')
                {{ $message }} 
                @enderror
            </p>
        </div>
        <div class="form-area">
            <label class="form__label">建物名</label>
            <input class="form__input" type="text" name="building" value="{{$user->building}}">
            <p class="form__error-message">
                @error('building')
                {{ $message }} 
                @enderror
            </p>
        </div>
        <button class="form__button">更新する</button>
    </form>
</div>
@endsection