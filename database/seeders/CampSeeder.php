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
            'name' => '어거스트캠핑장',
            'tel' => '010-0000-0000',
            'address' => '가산면 우금3길 142-29',
            'state' => '경기도',
            'county' => '포천시',
            'latitude' => 37.8181789,
            'longitude' => 127.2275313,
            'info_text' => '엄청엄청 좋은 캠핑장입니다',
            // 'link' => 'https://www.naver.com/',
            'price' => 45000,
            'main_img' => '/img_nr/캠핑장1.png',
        ];
        Camp::factory(10)->create($data);
        // Camp::factory(10)->create();
    }
}
