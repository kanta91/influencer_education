@extends('layouts.app')

@section('content')
<article class="notification-detail">
    <time datetime="{{ $notice->posted_date->toDateString() }}">
        {{ $notice->posted_date->format('Y年n月j日') }}
    </time>
    <h2 class="page-title">{{ $notice->title }}</h2>
    <div class="notification-body">
        {!! nl2br(e($notice->article_contents)) !!}
    </div>
</article>
@endsection