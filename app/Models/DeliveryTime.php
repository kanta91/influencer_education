<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DeliveryTime extends Model
{
    public function getByCurriculumId($curriculumId){
        $delivery_times = DB::table('delivery_times')
            ->where('curriculum_id', $curriculumId)
            ->get();
        
        return $delivery_times;
    }
}
