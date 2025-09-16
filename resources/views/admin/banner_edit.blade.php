@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto text-center">
    {{-- ←戻るボタン --}}
    <div class="text-2xl mt-2 mb-2 ml-10 text-left">
        <a href="{{ route('admin.show.top') }}"
        class="text-black-600 hover:underline text-lg">← 戻る</a>
     </div>

    <h2 class="text-3xl mb-4 ml-10 font-bold text-left">バナー管理</h2>

    @if(session('success'))
        <div class="text-green-600 mb-4">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.update.banner') }}" method="post" enctype="multipart/form-data" class="inline-block">
        @csrf
        <div id="banner-list" class="space-y-4">
            @foreach($banners as $banner)
                <div class="flex items-center space-x-4">
                    {{-- 画像 --}}
                    <img src="{{ asset('storage/'.$banner->image) }}" 
                    alt="banner" class="w-40 h-24 object-cover rounded border" />
                    {{-- ファイル選択 --}}
                    <input type="file" name="images[]" 
                    class="border rounded px-2 py-1 text-sm" />
                    {{-- 削除ボタン（－赤丸） --}}
                    <button type="button" onclick="deleteBanner({{ $banner->id }})" 
                    class="w-8 h-8 flex items-center justify-center rounded-full bg-red-500 text-white text-xl font-bold hover:bg-red-600">－</button>
                </div>
            @endforeach
        </div>

        {{-- 追加ボタン（＋緑丸） --}}
        <div class="mt-5">
            <button type="button" onclick="addBanner()" 
            class="w-10 h-10 flex items-center justify-center rounded-full bg-green-500 text-white text-2xl font-bold hover:bg-green-600">＋</button>
        </div>

        {{-- 登録ボタン --}}
        <div class="mt-6">
            <button type="submit" class="bg-gray-600 text-white px-6 py-2 rounded shadow hover:bg-gray-700">登録</button>
        </div>
    </form>

    {{-- 削除用フォーム --}}
    <form id="delete-form" method="post" style="display:none;">
        @csrf
        @method('DELETE')
    </form>
</div>

<script>
function deleteBanner(id) {
    if (confirm('削除してよろしいですか？')) {
        let form = document.getElementById('delete-form');
        form.action = "/admin/banner_delete/" + id;
        form.submit();
    }
}

function addBanner() {
    let list = document.getElementById('banner-list');
    let div = document.createElement('div');
    div.classList.add('flex','items-center','space-x-4');
    div.innerHTML = `
        <img src="https://via.placeholder.com/160x100?text=No+Image" 
        class="w-40 h-24 object-cover rounded border" />
        <input type="file" name="images[]" 
        class="border rounded px-2 py-1 text-sm" />
        <button type="button" onclick="this.parentElement.remove()" 
        class="w-8 h-8 flex items-center justify-center rounded-full bg-red-500 text-white text-xl font-bold hover:bg-red-600">－</button>
    `;
    list.appendChild(div);
}
</script>
@endsection