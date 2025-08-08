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

                        <div class="card-body">
                            <h4 class="card-title">{{ $curriculum->title }}</h4>

                            <ul class="delivery-dates">
                            @foreach ($curriculum->delivery_times as $time)
                                <div>{{ \Carbon\Carbon::parse($time->delivery_from)->format('Y-m-d H:i') }} 〜 {{ \Carbon\Carbon::parse($time->delivery_to)->format('Y-m-d H:i') }}</div>
                            @endforeach
                            </ul>
                        </div>

                        <div class="button-group">
                            <a href="{{ route('admin.show.curriculum.edit', ['id' => $curriculum->id]) }}" class="btn btn-primary">授業内容編集</a>
                            <a href="{{ route('admin.show.delivery.edit', ['curriculumId' => $curriculum->id]) }}" class="btn btn-primary">配信日時編集</a>
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
                            // 配信日時リストを生成
                            let deliveryList = '';
                            if (Array.isArray(c.delivery_times) && c.delivery_times.length > 0) {
                                c.delivery_times.forEach(dt => {
                                    const from = dt.delivery_from ? dt.delivery_from.substring(0, 12) : '';
                                    const to = dt.delivery_to ? dt.delivery_to.substring(0, 12) : '';
                                    deliveryList += `<li>${from} ~ ${to}</li>`;
                                });
                            } else {
                                deliveryList = '<li>配信日時なし</li>';
                            }

                            grid.innerHTML += `
                                <div class="curriculum-card">
                                    <img src="/storage/images/${c.thumbnail ?? 'images/sample.jpg'}" class="thumbnail" />
                                    <h4>${c.title}</h4>
                                    <ul class="delivery-dates">
                                        ${deliveryList}
                                    </ul>
                                    <div class="button-group">
                                        <a href="/admin/curriculum_edit/${c.id}" class="btn btn-primary">授業内容編集</a>
                                        <a href="/admin/delivery_edit/${c.id}" class="btn btn-primary">配信日時編集</a>
                                    </div>
                                </div>
                            `;
                        });

                        const gradeName = button.textContent.trim();
                        document.querySelector('.current-grade').textContent = `${gradeName}の授業`;
                    });
            });
        });
    </script>
@endsection
