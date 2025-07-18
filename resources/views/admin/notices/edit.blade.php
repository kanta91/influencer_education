@extends('layouts.app')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('css/admin_notice_edit.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="notice-edit-form">
    <h2 class="mb-4">{{ isset($notice) ? 'お知らせ変更' : 'お知らせ新規登録' }}</h2>

    {{-- フォーム --}}
    @if (isset($notice))
        <form method="POST" action="{{ route('admin.notice.update', $notice->id) }}">
        @method('PUT')
    @else
        <form method="POST" action="{{ route('admin.notice.store') }}">
    @endif
        @csrf

        {{-- 投稿日時 --}}
        <div class="form-section">
            <label for="posted_date" class="form-label">投稿日時</label>
            <input type="datetime-local" name="posted_date" id="posted_date" class="form-control"
                value="{{ old('posted_date', isset($notice) ? \Carbon\Carbon::parse($notice->posted_date)->format('Y-m-d\TH:i') : '') }}">
            @error('posted_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- タイトル --}}
        <div class="mb-3">
            <label for="title" class="form-label">タイトル</label>
            <input type="text" name="title" id="title" class="form-control"
                value="{{ old('title', $notice->title ?? '') }}">
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- 本文 --}}
        <div class="mb-3">
            <label for="article_contents" class="form-label">本文</label>
            <textarea name="article_contents" id="article_contents" class="form-control" rows="5">{{ old('article_contents', $notice->article_contents ?? '') }}</textarea>
            @error('article_contents')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- 登録ボタン --}}
        <button type="submit" class="btn btn-dark-cyan">登録</button>
    </form>
</div>
@endsection