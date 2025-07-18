<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateUserProfileRequest;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    
    public function edit()
    {
        
        if (!Auth::check()) {
            Auth::loginUsingId(1);
        }

        $user = Auth::user();

        return view('user.profile', compact('user'));
    }


    
    public function update(UpdateUserProfileRequest $request)
    {
        if (!Auth::check()) {
            Auth::loginUsingId(1);
        }

        $user = Auth::user();
        $validated = $request->validated();

        try {
            DB::beginTransaction();

           
            $user->updateProfile($validated, $request);

            DB::commit();
            return redirect()->route('user.profile.edit')->with('success', 'プロフィールを更新しました。');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => '更新中にエラーが発生しました。'])->withInput();
        }
    }

}