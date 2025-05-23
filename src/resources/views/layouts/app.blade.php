<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COACHTECH Flea Market</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    @yield('css')

</head>
<body>
    <header class="header">	
        <a class="header__logo" href="/">
            <img src="{{asset('img/logo.svg')}}" alt="COACHTECH">
        </a>
        @if(!View::hasSection('no-nav'))
        <input class="header-nav__search" type="text" placeholder="なにをお探しですか？">
        <div class="header-nav__buttons">
            <button>ログアウト</button>
            <button>マイページ</button>
            <button>出品</button>
        </div>
        @endif
    </header>
    <main>
    @yield('content')
    </main>  
</body>
</html>