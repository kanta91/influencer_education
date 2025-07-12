@extends('layouts.app')

@section('content')
<div class="progress-container" style="max-width: 960px; margin: 0 auto;">
    <h2 class="mb-4">パスワード変更</h2>

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

    <form action="{{ route('user.password.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3 d-flex align-items-center">
            <label for="current_password" class="fixed-label">旧パスワード</label>
            <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror" style="flex:1;">
            @error('current_password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 d-flex align-items-center">
            <label for="new_password" class="fixed-label">新パスワード</label>
            <input type="password" name="new_password" id="new_password" class="form-control @error('new_password') is-invalid @enderror" style="flex:1;">
            @error('new_password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 d-flex align-items-center">
            <label for="new_password_confirmation" class="fixed-label">新パスワード確認</label>
            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control @error('new_password_confirmation') is-invalid @enderror" style="flex:1;">
            @error('new_password_confirmation')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 text-center">
            <button type="submit" class="btn btn-orange px-5">登録</button>
        </div>

    </form>
</div>
@endsection
