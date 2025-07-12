@extends('layouts.app')

@section('content')
<div class="progress-container" style="max-width: 960px; margin: 0 auto;">
    
    <h2 class="mb-4">プロフィール設定</h2>

    {{-- 成功メッセージ --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- バリデーションエラー --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3 d-flex align-items-center gap-3">
            {{-- プロフィール画像 --}}
            @if ($user->profile_image)
                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="プロフィール画像" width="100" height="100" class="rounded-circle">
            @else
                <div style="width: 100px; height: 100px; background: #ccc; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    画像未登録
                </div>
            @endif

            {{-- ラベルとファイル選択ボタン --}}
            <div>
                <label for="profile_image" class="form-label">プロフィール画像</label>
                <input type="file" name="profile_image" id="profile_image" class="form-control">
            </div>
        </div>

        {{-- 入力フォーム群 --}}
        @php
            // ラベル固定幅のクラス
            $labelClass = 'form-label fixed-label';
        @endphp

        <div class="mb-3 d-flex align-items-center">
            <label for="name" class="{{ $labelClass }}">ユーザーネーム</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror" style="flex:1;">
            @error('name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 d-flex align-items-center">
            <label for="name_kana" class="{{ $labelClass }}">カナ</label>
            <input type="text" name="name_kana" id="name_kana" value="{{ old('name_kana', $user->name_kana) }}" class="form-control @error('name_kana') is-invalid @enderror" style="flex:1;">
            @error('name_kana')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 d-flex align-items-center">
            <label for="email" class="{{ $labelClass }}">メールアドレス</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror" style="flex:1;">
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        {{-- パスワード変更部分 --}}
        <div class="mb-3 d-flex align-items-center">
            <label class="{{ $labelClass }} mb-0">パスワード</label>
            <a href="{{ route('user.password.edit') }}" class="btn btn-outline-secondary">パスワードを変更する</a>
        </div>

        {{-- 登録ボタン --}}
        <div class="mb-3 text-center">
            <button type="submit" class="btn btn-orange px-5">登録</button>
        </div>


    </form>
</div>

@endsection
