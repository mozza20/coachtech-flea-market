@extends('layouts.app')

@section('content')
<div class="content">
    <h2>メールアドレスの確認</h2>
    <p>確認メールを送信しました。メール内のリンクをクリックしてください。</p>
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit">再送信</button>
    </form>
</div>

<style>
    h2{
        font-size:36px;
    }
    p{
        font-size:24px;
    }
    button{
        width:150px;
        height:50px;
        line-height:50%;
        border-radius:5px;
        font-size:24px;
    }
@endsection
