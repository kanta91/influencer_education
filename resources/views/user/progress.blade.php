@extends('layouts.app')

@section('content')
<div class="progress-container">
    {{-- プロフィール情報 --}}
    <div class="profile-section">
        <img src="{{ $user->profile_image ?? asset('images/default-profile.svg') }}" alt="プロフィール画像" class="profile-img">
        <div class="profile-info">
            <h2>{{ $user->name }}さんの授業進捗</h2>
            <div class="current-grade">
                <span>現在の学年：</span>
                <span class="grade-badge {{ \App\Helpers\GradeHelper::gradeColorClass($user->grade->grade_name ?? '') }}">
                    {{ $user->grade->grade_name ?? '未設定' }}
                </span>
            </div>
        </div>
    </div>

    <div class="grades-container">
        @foreach($grades->chunk(3) as $gradeChunk)
            <div class="grade-row">
                @foreach($gradeChunk as $grade)
                    <div class="grade-section">
                        <div class="grade-header {{ \App\Helpers\GradeHelper::gradeColorClass($grade->grade_name) }}">
                            {{ $grade->grade_name }}
                        </div>
                        <ul class="lesson-list">
                            @foreach($grade->classes->take(5) as $class)
                                <li class="lesson-item">
                                    @if($class->is_completed ?? false)
                                        <span class="completed-badge">受講済</span>
                                    @endif
                                    <span class="lesson-title">授業{{ $class->title }}</span>
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