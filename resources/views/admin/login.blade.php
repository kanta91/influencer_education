<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>管理者ログイン</title>
</head>
<body>
    <h1>管理者ログイン</h1>
    <form method="post" action="{{ route('admin.login.submit') }}">
        @csrf
        <div>
            <label for="email">メールアドレス：</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
        </div>
        <div>
            <label for="password">パスワード：</label>
            <input type="password" name="password" id="password" required>
        </div>
        <button type="submit">ログイン</button>
    </form>

    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <p style="color:red;">{{ $error }}</p>
            @endforeach
        </div>
    @endif
</body>
</html>