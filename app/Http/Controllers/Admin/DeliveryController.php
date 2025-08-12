<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Curriculum;
use App\Models\DeliveryTime;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeliveryRequest;
use Illuminate\Support\Facades\DB;

class DeliveryController extends Controller
{
    public function showDeliveryEdit($curriculumId){

        $CurriculumModel = new Curriculum();
        $DeliveryTimeModel = new DeliveryTime();

        $curriculum = $CurriculumModel->where('id', $curriculumId)->first();
        $deliveryTime = $DeliveryTimeModel->getByCurriculumId($curriculumId);

        return view('admin.delivery' , compact('curriculum','deliveryTime'));

    }

    public function DeleteDeliveryTime($id){

        DB::beginTransaction();

        try {
            $DeliveryTimeModel = new DeliveryTime();
            $DeliveryTimeModel->DeleteDeliveryTime($id);
            DB::commit();
            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => '削除に失敗しました'], 500);
        }
    }


    public function UpdateDeliveryTime(DeliveryRequest $request, $curriculumId){

        DB::beginTransaction();

        try {
            $model = new DeliveryTime();
            $model -> DeleteDeliveryTime($curriculumId);
            $model->UpdateDeliveryTime($request,$curriculumId);
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return back();
        }

        return redirect()->route('admin.show.curriculum.list')->with('success', '配信日時を登録しました');

    }
}
