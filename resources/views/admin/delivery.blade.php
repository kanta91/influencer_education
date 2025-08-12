@extends('layouts.app')

@section('title', '配信日時設定')

@section('content')

<a href="{{ route('admin.show.curriculum.list') }}" class="backbtn">←戻る</a>

<h1 class="page-title">配信日時設定</h1>
<h2>{{ $curriculum->title }}</h2>

<form action="{{ route('admin.delivery.update', ['curriculumId' => $curriculum->id]) }}" method="POST">
    @csrf

    <div id="delivery-schedule-list">
        @php
            $oldDelivery = old('delivery', $deliveryTime ?? []);
        @endphp

        @foreach ($oldDelivery as $index => $item)
            <div class="delivery-row">
            @php
                $fromDate = old("delivery.$index.from_date", isset($item->delivery_from) ? str_replace('-', '', substr($item->delivery_from, 0, 10)) : '');
                $fromTime = old("delivery.$index.from_time", isset($item->delivery_from) ? str_replace(':', '', substr($item->delivery_from, 11, 5)) : '');

                $toDate   = old("delivery.$index.to_date", isset($item->delivery_to) ? str_replace('-', '', substr($item->delivery_to, 0, 10)) : '');
                $toTime   = old("delivery.$index.to_time", isset($item->delivery_to) ? str_replace(':', '', substr($item->delivery_to, 11, 5)) : '');
            @endphp

                <div class="delivery-container">
                    <input type="text" name="delivery[{{ $index }}][from_date]" value="{{ $fromDate }}" placeholder="開始日">
                    @error("delivery.$index.from_date")
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <input type="text" name="delivery[{{ $index }}][from_time]" value="{{ $fromTime }}" placeholder="開始時間">
                    @error("delivery.$index.from_time")
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    〜

                    <input type="text" name="delivery[{{ $index }}][to_date]" value="{{ $toDate }}" placeholder="終了日">
                    @error("delivery.$index.to_date")
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <input type="text" name="delivery[{{ $index }}][to_time]" value="{{ $toTime }}" placeholder="終了時間">
                    @error("delivery.$index.to_time")
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <button type="button" class="remove-btn">−</button>
                </div>
            </div>
        @endforeach
    </div>

    <button type="button" id="add-schedule-btn">＋</button><br><br>
    <button type="submit" class="btn btn-primary">登録</button>
</form>

<script>
    let index = {{ isset($deliveryTime) ? count($deliveryTime) : 1 }};

    document.getElementById('add-schedule-btn').addEventListener('click', function () {
        const container = document.getElementById('delivery-schedule-list');

        const row = document.createElement('div');
        row.classList.add('delivery-row');
        row.innerHTML = `
            <input type="text" name="delivery[${index}][from_date]" placeholder="開始日">
            <input type="text" name="delivery[${index}][from_time]" placeholder="開始時間">
            〜
            <input type="text" name="delivery[${index}][to_date]" placeholder="終了日">
            <input type="text" name="delivery[${index}][to_time]" placeholder="終了時間">
            <button type="button" class="remove-btn">−</button>
        `;
        container.appendChild(row);
        index++;
    });

    document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('remove-btn')) {
            e.target.closest('.delivery-row').remove(); // ←親のrowごと消す
        }
    });
</script>

@endsection