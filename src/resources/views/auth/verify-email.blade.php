<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>

<body>
    <div class="content">
        <h1>メール認証</h1>
        <p>認証リンクのEメールを確認してください。</p>
        <p>メールが届かない場合は、下記を確認メールをおして再送信をして下さい。</p>
        @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success" role="alert">
            新しい確認用リンクが送信されました。
        </div>
        @endif
        <form action="{{ route('verification.resend') }}" method="post">
            @csrf
            <button type="submit">確認メールを再送信する</button>
        </form>
    </div>
</body>

</html>