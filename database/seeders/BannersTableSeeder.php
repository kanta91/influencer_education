<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Banner::create([
            'image' => 'storage/images/banner/sample1.jpg',
        ]);
        Banner::create([
            'image' => 'storage/images/banner/sample2.jpg',
        ]);
        Banner::create([
            'image' => 'storage/images/banner/sample3.jpg',
        ]);
    }
}
