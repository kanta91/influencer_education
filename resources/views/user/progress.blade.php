@extends('layouts.app')

@section('content')
<div class="progress-container">

    {{-- ナビゲーション --}}
    <div class="navbar">
        <div class="nav-left">
            <a href="#">時間割</a>
            <a href="#">授業進捗</a>
            <a href="#">プロフィール設定</a>
        </div>
        <div class="nav-right">
           <span>ログアウト</span>
        </div>
    </div>

    {{-- 戻るボタン --}}
    <div class="back-btn">
        <a href="#">← 戻る</a>
    </div>

    {{-- プロフィール情報 --}}
    <div class="profile-info">
        <img src="{{ $user->profile_image ?? 'https://via.placeholder.com/100' }}" alt="プロフィール画像" class="profile-img">
        <div class="user-info">
            <h2>{{ $user->name }} さんの授業進捗</h2>
            <p>
                現在の学年：
                <span class="{{ gradeColorClass($user->grade->grade_name ?? '') }} grade-label">
                    {{ $user->grade->grade_name ?? '未設定' }}
                </span>
            </p>
        </div>
    </div>


    {{-- 学年ごとの授業を3列で表示 --}}
    <div class="grades-container">

    @php
        use Illuminate\Support\Str;

        function gradeColorClass($gradeName) {
            if (Str::startsWith($gradeName, '小学校')) return 'elementary';
            if (Str::startsWith($gradeName, '中学校')) return 'middle';
            if (Str::startsWith($gradeName, '高校')) return 'high';
            return '';
        }
    @endphp

    {{-- 学年を3つずつグループにして並べる --}}
    @foreach($grades->chunk(3) as $gradeChunk)
    <div class="grades-grid">
        @foreach($gradeChunk as $grade)
            <div class="grade-col">
                {{-- 学年名にだけ色付け --}}
                <div class="grade-label {{ gradeColorClass($grade->grade_name) }}">
                    {{ $grade->grade_name }}
                </div>

                <ul>
                    @foreach($grade->classes->take(5) as $class)
                        <li>
                            @if($class->is_completed ?? false)
                                <span class="completed-label">受講済</span>
                            @endif
                            授業{{ explode('（', $class->title)[0] }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
@endforeach



</div>


</div>
@endsection
