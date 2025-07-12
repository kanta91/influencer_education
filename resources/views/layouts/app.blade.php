<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'MyApp')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSSの読み込み --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    {{-- ナビゲーションバー --}}
    <div class="navbar">
    <div class="navbar-container container">
        <div class="nav-left">
            <a href="#">時間割</a>
            <a href="#">授業進捗</a>
            <a href="{{ route('user.profile.edit') }}">プロフィール設定</a>
        </div>
        <div class="nav-right">
            <span>ログアウト</span>
        </div>
    </div> 
</div> 

    {{-- メインコンテンツ --}}
    <main class="container">
       <div class="back-button mb-3">
            <button type="button" class="btn btn-secondary" onclick="history.back();">戻る</button>
        </div>


        @yield('content')
    </main>


    <footer class="text-center mt-5 mb-3 text-muted">
        &copy; {{ date('Y') }} MyApp All rights reserved.
    </footer>


    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>