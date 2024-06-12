<?php

namespace Database\Seeders;

use App\Models\Community;
use App\Models\CommunityType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'user_id' => 1,
            'title' =>'테스트',
            'content' =>'테스트테스트',
            'img' =>'/public/img/sample.jpg',
        ];

        Community::create($data);
    }
}
