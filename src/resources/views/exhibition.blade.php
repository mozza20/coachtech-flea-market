@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/exhibition.css') }}">
@endsection

@section('content')
<div class="exhibition">
    <div class="img-area">
        <img class="item-img" src="" alt="商品画像">
    </div>
    <div class="detail-area">
        <h2 class="item-name">{{$item['name']}}</h2>
        <p class="item-brand">{{$item['brand']}}</p>
        <p class="item-price">￥<span>{{number_format($item['price'])}}</span>(税込)</p>
        <form class="interaction" action="{{route('items.toggleLike',['item_id'=>$item->id])}}" method="POST"  data-item-id="{{ $item->id }}">
            @csrf
            <div class="liked">
                <button class="icon" type="submit">
                    <img class="icon__star" src="{{asset('img/star.png')}}" alt="いいね" id="star-icon-{{ $item->id }}">
                </button>
                <p class="count" id="like-count-{{ $item->id }}">{{ $item->like_count }}</p>
            </div>
            <div class="comment">
                <img class="icon" src="{{asset('img/speech-bubble.png')}}" alt="コメント">
                <p class="count">{{ $comments->count() }}</p>
            </div>
        </form>
        <a class="purchase__button" href="/purchase/{{$item->id}}">購入手続きへ</a>
        <div class="item-description">
            <h3>商品説明</h3>
            <p class="description__content">{{$item['description']}}</p>
        </div>
        <div class="item-info">
            <h3>商品の情報</h3>
            <div class="info__content">
                <p class="subtitle">カテゴリー</p>
                <div class="categories">
                    @foreach($item->categories as $category)
                    <p class="each-categories">{{$category->content}}</p>
                    @endforeach
                </div>
            </div>
            <div class="info__content">
                <p class="subtitle">商品の状態</p>
                <p class="condition">{{$item->condition['selection']}}</p>
            </div>
        </div>
        <div>
            <p class="comment__title">コメント<span>{{ $comments->count() }}</span></p>
            @if(isset($comments) && $comments->count() > 0)
            @foreach($comments as $comment)
            <div class="comment__user">
                <img class="user-img" src="">
                <p class="user-name">{{$comment->user->name}}</p>
            </div>
            <p class="user-comment">{{$comment->content}}</p>
            @endforeach
            @endif
            <form class="comment__input-area" action="{{route('store.comment', ['item_id' => $item->id])}}" method="POST">
                @csrf
                <label class="comment__label">商品へのコメント</label>
                <textarea class="comment__input" name="content">{{old('content')}}</textarea>
                <div class="form__error-message">
                    @error('content')
                    {{$message}}
                    @enderror
                </div>
                <button class="submit__button">コメントを送信する</button>
            </form>
        </div>
    </div>
    {{-- いいねしたときの画面上の動き --}}
    <script>
    document.querySelectorAll('.interaction').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const url = this.action;
            const token = this.querySelector('input[name="_token"]').value;
            const itemId = this.dataset.itemId;

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                const likeCountElement = document.getElementById(`like-count-${itemId}`);
                const starIconElement = document.getElementById(`star-icon-${itemId}`);

                likeCountElement.textContent = data.like_count;

                if (data.liked) {
                    starIconElement.src = '{{ asset('img/star_on.png') }}';
                } else {
                    starIconElement.src = '{{ asset('img/star.png') }}';
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
    </script>
</div>
@endsection