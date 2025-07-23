@extends('layouts.app')

@section('title', '授業一覧')
@section('content')

    <a href="#" class="backbtn">←戻る</a>

    <h1 class="page-title">授業一覧</h1>

    <a href="{{ route('admin.show.curriculum.create') }}" class="btn btn-lg btn-primary create-btn">新規登録</a>

    <div class="curriculum-wrapper">
        <aside class="sidebar">
        @foreach($grades as $grade)
            @php
                $gradeClass = 'grade-btn'; 
                if (str_contains($grade->grade_name, '小学校')) {
                    $gradeClass .= ' elementary';
                } elseif (str_contains($grade->grade_name, '中学校')) {
                    $gradeClass .= ' junior';
                } elseif (str_contains($grade->grade_name, '高校')) {
                    $gradeClass .= ' senior';
                }
            @endphp
             <a href="{{ route('admin.show.curriculum.list', $grade->id) }}" class="{{ $gradeClass }}">
                {{ $grade->grade_name }}
            </a>
        @endforeach
        </aside>

        <main class="curriculum-main">
            <div class="current-grade">{{ $selectedGrade->grade_name }}の授業</div>

            <div class="curriculum-grid">
                @foreach ($curriculums as $curriculum)
                    <div class="curriculum-card">
                    <img src="{{ asset('storage/images/' . ($curriculum->thumbnail ?? 'images/sample.jpg')) }}" alt="サムネイル" class="thumbnail">

                        <h4>{{ $curriculum->title }}</h4>

                        <ul class="delivery-dates">
                            <li>{{ $curriculum->delivery_from ?? '7月13日' }} ~ {{ $curriculum->delivery_to ?? '7月13日' }}</li>
                            <li>{{ $curriculum->delivery_from ?? '7月13日' }} ~ {{ $curriculum->delivery_to ?? '7月13日' }}</li>
                            <li>{{ $curriculum->delivery_from ?? '7月13日' }} ~ {{ $curriculum->delivery_to ?? '7月13日' }}</li>
                        </ul>

                        <div class="button-group">
                            <a href="{{ route('admin.show.curriculum.edit', $curriculum->id) }}" class="btn btn-sm btn-primary">授業内容編集</a>
                            <a href="{{ route('admin.show.delivery.edit', $curriculum->id) }}" class="btn btn-sm btn-primary">配信日時編集</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </main>
    </div>

    <script>
        document.querySelectorAll('.grade-btn').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const gradeId = this.getAttribute('href').split('/').pop(); 

                fetch(`/admin/ajax/curriculums/${gradeId}`)
                    .then(response => response.json())
                    .then(data => {
                        const grid = document.querySelector('.curriculum-grid');
                        grid.innerHTML = ''; 

                        data.forEach(c => {
                            grid.innerHTML += `
                                <div class="curriculum-card">
                                    <img src="/storage/images/${c.thumbnail ?? 'images/sample.jpg'}" class="thumbnail" />
                                    <h4>${c.title}</h4>
                                    <ul class="delivery-dates">
                                        <li>${c.delivery_from ?? '7月13日'} ~ ${c.delivery_to ?? '7月13日'}</li>
                                        <li>${c.delivery_from ?? '7月13日'} ~ ${c.delivery_to ?? '7月13日'}</li>
                                        <li>${c.delivery_from ?? '7月13日'} ~ ${c.delivery_to ?? '7月13日'}</li>
                                    </ul>
                                    <div class="button-group">
                                        <a href="/admin/curriculum_edit/${c.id}" class="btn btn-primary">授業内容編集</a>
                                        <a href="/admin/delivery_edit/${c.id}" class="btn btn-primary">配信日時編集</a>
                                    </div>
                                </div>
                            `;
                        });

                        const gradeName = this.textContent.trim();
                        document.querySelector('.current-grade').textContent = `${gradeName}の授業`;
                    });
            });
        });
    </script>
@endsection
