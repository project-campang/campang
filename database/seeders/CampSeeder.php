<?php

namespace Database\Seeders;

use App\Models\Camp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => '데일리랜드',
            'tel' => '010-4825-2707',
            'address' => '강원특별자치도 춘천시 동산면 봉명리 35',
            'state' => '강원도',
            'country' => '춘천시',
            'latitude' => 37.7608264,
            'longitude' => 127.8469049,
            'info_text' => '오토캠핑 야영장입니다',
            'max_capacity' => 64,
            'main_img' => '/img/logo-ko3.png',
            'other_img_1' => '/img/logo-ko3.png',
        ];
        Camp::create($data);
    }
}
