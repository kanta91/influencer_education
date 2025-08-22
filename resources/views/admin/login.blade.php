<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>管理者ログイン</title>
    <link rel="stylesheet" href="{{ asset('css/admin.login.css') }}">
</head>
<body>
<div class="login-container">
    <div class="register-link">
        <a href="{{ route('admin.show.register') }}">新規会員登録はこちら</a>
    </div>

    <h1 class="login-title">管理画面ログイン</h1>

    @if ($errors->any())
        <div class="error-messages">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="post" action="{{ route('admin.login.submit') }}">
        @csrf
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="text" name="email" value="{{ old('email') }}" maxlength="255" required>
        </div>
        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" name="password" maxlength="255" required>
        </div>
        <div class="form-group">
            <button type="submit" class="login-btn">ログイン</button>
        </div>
    </form>
</div>
</body>
</html>