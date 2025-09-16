<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\BannerRequest;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    public function showBannerEdit()
    {
        $banners = Banner::all();
        return view('admin.banner_edit', compact('banners'));
    }

    public function update(BannerRequest $request)
    {
        DB::transaction(function () use ($request) {
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    if ($image) {
                        $filename = $image->getClientOriginalName();
                        $path = $image->storeAs('images/banner', $filename, 'public');
                        Banner::create(['image' => $path,]);
                    }
                }
            }
        });

        return redirect()->route('admin.show.banner.edit')->with('success', '登録が完了しました！');
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $banner = Banner::findOrFail($id);
            if ($banner->image && \Storage::disk('public')->exists($banner->image)) {
                \Storage::disk('public')->delete($banner->image);
            }
            $banner->delete();
        });

        return redirect()->route('admin.show.banner.edit')->with('success', '削除しました');
    }
}