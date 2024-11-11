<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <header class="header">
        <header class="header__inner">
            <header class="header__logo">Atte</header>
        </header>
    </header>

    <main>
        <div class="login__content">
            <div class="login-form__heading">
                <h2>ログイン</h2>
            </div>
            <form action="{{ route('login') }}" class="form" method="post">
                @csrf
                <div class="form__group">
                    <div class="form__input--text">
                        <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
                    </div>
                    <div class="form__error">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__input--text">
                        <input type="password" name="password" placeholder="パスワード">
                    </div>
                    <div class="form__error">
                        @error('password')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form__button">
                    <button class="form__button-submit" type="submit">ログイン</button>
                </div>
            </form>
            <div class="register__link">
                <p class="register__link-p">アカウントをお持ちでない方はこちらから</p>
                <a href="/register" class="register__button-submit">会員登録</a>
            </div>
        </div>
        <div class="small">
            <small>Atte,inc.</small>
        </div>
    </main>
</body>
</html>
