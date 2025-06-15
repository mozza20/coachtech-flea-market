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
@endsection
