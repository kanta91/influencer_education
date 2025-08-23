<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>新規管理ユーザー登録</title>
    <link rel="stylesheet" href="{{ asset('css/admin.register.css') }}">
</head>
<body>
<div class="register-container">
    <div class="register-box">
        <h2 class="title">新規管理ユーザー登録</h2>

        <a href="{{ route('admin.show.login') }}" class="login-link">ログインはこちら</a>

        <form method="POST" action="{{ route('admin.show.register') }}">
            @csrf

            <div class="form-group">
                <label for="name">ユーザーネーム</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}">
                @error('name')<span class="error">{{ $message }}</span>@enderror
            </div>

             <div class="form-group">
                <label for="kana">カナ</label>
                <input id="kana" type="text" name="kana" value="{{ old('kana') }}">
                @error('kana')<span class="error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}">
                @error('email')<span class="error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="password">パスワード</label>
                <input id="password" type="password" name="password">
                @error('password')<span class="error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">パスワード確認</label>
                <input id="password_confirmation" type="password" name="password_confirmation">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-register">登録</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>