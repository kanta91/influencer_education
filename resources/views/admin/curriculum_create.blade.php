@extends('layouts.app')

@section('title','授業設定')

@section('content')

    <a href="{{ route('admin.show.curriculum.list') }}" class="backbtn">←戻る</a>

    <h1 class="page-title">授業設定</h1>

    <form action="{{ route('admin.show.curriculum.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="">サムネイル</label>
            <input type="file" name="thumbnail" accept="image/*" class="thumbnail">
        </div>

        <div class="form-group">
            <label for="">学年</label>
            <select name="grade_id">
                <option value="">選択してください</option>
                @foreach ($grades as $grade)
                    <option value="{{ $grade->id }}" {{ old('grade_id') == $grade->id ? 'selected' : '' }}>
                        {{ $grade->grade_name }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('grade_id'))
                <p style="color: red;">{{ $errors->first('grade_id') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="">授業名</label>
            <input type="text" name="title" class="title" value="{{ old('title') }}">
            @if ($errors->has('title'))
                <p style="color: red;">{{ $errors->first('title') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="">動画URL</label>
            <input type="url" name="video_url" class="video_url" value="{{ old('video_url') }}">
            @if ($errors->has('video_url'))
                <p style="color: red;">{{ $errors->first('video_url') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="">授業概要</label>
            <textarea name="description">{{ old('description') }}</textarea>
            @if ($errors->has('description'))
                <p style="color: red;">{{ $errors->first('description') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for=""><input type="checkbox" name="alway_delivery_flg" value="1" class="checkbox" {{ old('alway_delivery_flg') ? 'checked' : ''}}>常時公開</label>
        </div>

        <div class="register-btn">
            <button type="submit" class="btn btn-primary">登録</button>
        </div>
    </form>

@endsection
