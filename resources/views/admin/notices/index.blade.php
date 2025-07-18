@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 960px; margin: 0 auto; padding: 0 20px; box-sizing: border-box;">
    <h1 class="mb-3">お知らせ一覧</h1>
    
    <div class="mb-3">
        <a href="{{ route('admin.notice.create') }}" class="btn btn-primary btn-sm">新規登録</a>
    </div>
    
    <div class="table-responsive">
        <table class="table align-middle" style="table-layout: fixed;">
            <thead>
                <tr>
                    <th style="width: 150px;">投稿日時</th>
                    <th>タイトル</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($notices as $notice)
                <tr>
                    <td>{{ $notice->posted_date->format('Y年n月j日') }}</td>
                    <td style="word-wrap: break-word;">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>{{ $notice->title }}</span>
                            <div class="ms-1">
                                <a href="{{ route('admin.notice.edit', $notice->id) }}" class="btn btn-dark-cyan btn-sm me-2">変更する</a>
                                <form action="{{ route('admin.notice.destroy', $notice->id) }}" method="POST" class="d-inline" onsubmit="return confirm('本当に削除しますか？');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-vermillion btn-sm">削除</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
                
                @if ($notices->isEmpty())
                <tr>
                    <td colspan="2" class="text-center">お知らせはありません。</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection