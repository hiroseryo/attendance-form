<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
    <header class="header">
        <header class="header__inner">
            <header class="header__logo">Atte</header>
        </header>
    </header>

    <main>
        <div class="register__content">
            <div class="register-form__heading">
                <h2>会員登録</h2>
            </div>
            <form action="{{ route('register') }}" class="form" method="post">
                @csrf
                <div class="form__group">
                    <div class="form__input--text">
                        <input type="text" name="name" placeholder="名前" value="{{ old('name') }}">
                    </div>
                    <div class="form__error">
                        @error('name')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
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
                <div class="form__group">
                    <div class="form__input--text">
                        <input type="password" name="password_confirmation" placeholder="確認用パスワード">
                    </div>
                </div>
                <div class="form__button">
                    <button class="form__button-submit" type="submit">会員登録</button>
                </div>
            </form>
            <div class="login__link">
                <p class="login__link-p">アカウントをお持ちの方はこちらから</p>
                <a href="/login" class="login__button-submit">ログイン</a>
            </div>
        </div>
        <div class="small">
            <small>Atte,inc.</small>
        </div>
    </main>