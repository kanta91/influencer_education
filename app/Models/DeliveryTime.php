<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DeliveryTime extends Model
{
    public function getByCurriculumId($curriculumId){
        $delivery_times = DB::table('delivery_times')
            ->where('curriculum_id', $curriculumId)
            ->get();
        
        return $delivery_times;
    }


    public function showDeliveryDelete($id){
        return DB::table('delivery_times')
            ->where('id', $id)
            ->delete();
    }


    public function showDeliveryUpdate($request,$curriculumId){
        $deliveryData = $request->input('delivery', []);

        DB::table('delivery_times')
        ->where('curriculum_id', $curriculumId)
        ->delete();

        foreach ($deliveryData as $item) {
            // すべての項目が空ならスキップ
            if (
                empty($item['from_date']) &&
                empty($item['from_time']) &&
                empty($item['to_date']) &&
                empty($item['to_time'])
            ) {
                continue;
            }

            // 結合してフォーマット
            $deliveryFrom = \Carbon\Carbon::createFromFormat('YmdHi', $item['from_date'] . $item['from_time'])->format('Y-m-d H:i');
            $deliveryTo   = \Carbon\Carbon::createFromFormat('YmdHi', $item['to_date'] . $item['to_time'])->format('Y-m-d H:i');

            if (!empty($item['id'])) {
                DB::table('delivery_times')
                    ->where('id', $item['id'])
                    ->update([
                        'delivery_from' => $deliveryFrom,
                        'delivery_to' => $deliveryTo,
                        'updated_at' => now(),
                    ]);
            } else {
                DB::table('delivery_times')->insert([
                    'curriculum_id' => $curriculumId,
                    'delivery_from' => $deliveryFrom,
                    'delivery_to' => $deliveryTo,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
