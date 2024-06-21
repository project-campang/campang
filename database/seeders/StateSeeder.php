<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $data = [
            // ['name' => '서울특별시'],
            // ['name' => '부산광역시'],
            // ['name' => '대구광역시'],
            // ['name' => '인천광역시'],
            // ['name' => '광주광역시'],
            // ['name' => '대전광역시'],
            // ['name' => '울산광역시'],
            // ['name' => '세종시'],
            // ['name' => '경기도'],
            // ['name' => '강원도'],
            // ['name' => '충청북도'],
            // ['name' => '충청남도'],
            // ['name' => '전라북도'],
            // ['name' => '전라남도'],
            // ['name' => '경상북도'],
            // ['name' => '경상남도'],
            // ['name' => '제주도'],
        // ];

        State::create(['name' => '서울특별시']);
        State::create(['name' => '부산광역시']);
        State::create(['name' => '대구광역시']);
        State::create(['name' => '인천광역시']);
        State::create(['name' => '광주광역시']);
        State::create(['name' => '대전광역시']);
        State::create(['name' => '울산광역시']);
        State::create(['name' => '세종시']);
        State::create(['name' => '경기도']);
        State::create(['name' => '강원도']);
        State::create(['name' => '충청북도']);
        State::create(['name' => '충청남도']);
        State::create(['name' => '전라북도']);
        State::create(['name' => '전라남도']);
        State::create(['name' => '경상북도']);
        State::create(['name' => '경상남도']);
        State::create(['name' => '제주도']);
        
        // State::create($data);
    }
}
