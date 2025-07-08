<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'アプリケーション')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/curriculum_list.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="admin-header">
        <nav class="nav">
            <a href="#" class="nav-button">授業管理</a>
            <a href="#" class="nav-button">お知らせ管理</a>
            <a href="#" class="nav-button">バナー管理</a>
        </nav>

        <a href="#" class="logout">ログアウト</a>

    </div>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>