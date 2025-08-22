@extends('admin.layouts.app')

@section('content')
    <div class="top_page__container">
        <div class="top_page__user-info">
            <p class="top_page__label">ユーザーネーム：{{ $user->name }}</p>
            <p class="top_page__label">メールアドレス：{{ $user->email }}</p>
        </div>
    </div>
@endsection
