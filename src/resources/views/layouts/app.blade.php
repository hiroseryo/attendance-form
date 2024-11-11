<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
    @yield('js')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">
                <a href="/" class="header__logo">Atte</a>
                <nav>
                    <ul class="header-nav">
                        @if (Auth::check())
                        <li class="header-nav__item">
                            <a href="/" class="header-nav__link">ホーム</a>
                            <a href="/attendance" class="header-nav__link">日付一覧</a>
                            <a href="/staff" class="header-nav__link">従業員一覧</a>
                            <a href="/individual" class="header-nav__link">従業員勤怠表</a>
                        </li>
                        <li class="header-nav__item">
                            <form action="/logout" method="post">
                                @csrf
                                <button class="header-nav__button">ログアウト</button>
                            </form>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>