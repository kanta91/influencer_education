<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>管理画面</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <header class="admin-header">
        <nav class="admin-header__nav">
            <a href="{{ route('admin.show.curriculum.list') }}" class="admin-header__button">授業管理</a>
            <a href="{{ route('admin.show.article.list') }}" class="admin-header__button">お知らせ管理</a>
            <a href="{{ route('admin.show.banner.edit') }}" class="admin-header__button">バナー管理</a>
            <form method="POST" action="{{ route('admin.logout') }}" class="admin-header__logout-form">
                @csrf
                <button type="submit" class="admin-header__logout">ログアウト</button>
            </form>
        </nav>
    </header>

    <main class="admin-main">
        @yield('content')
    </main>
</body>
</html>