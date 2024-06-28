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
        // $data = [
        //     'name' => '어거스트캠핑장',
        //     'tel' => '010-0000-0000',
        //     'address' => '가산면 우금3길 142-29',
        //     'state' => '경기도',
        //     'county' => '포천시',
        //     'latitude' => 37.8181789,
        //     'longitude' => 127.2275313,
        //     'info_text' => '엄청엄청 좋은 캠핑장입니다',
        //     // 'link' => 'https://www.naver.com/',
        //     'price' => 45000,
        //     'main_img' => '/img_nr/캠핑장1.png',
        // ];
        // Camp::factory(10)->create($data);
        // // Camp::factory(10)->create();

        $totalRecords = 2200; // 전체 레코드 수
        $recordsPerGroup = 20; // 각 그룹당 복사할 레코드 수
        
        // 각 그룹당 복사할 횟수를 계산
        $numGroups = floor($totalRecords / $recordsPerGroup);
        
        // 레코드 복사 및 업데이트 작업 실행
        for ($i = 0; $i < $numGroups; $i++) {
            $startId = $i * $recordsPerGroup + 1;
            $endId = $startId + $recordsPerGroup - 1;
            
            $camps = Camp::whereBetween('id', [$startId, $endId])->get();
            
            foreach ($camps as $index => $camp) {
                $newIndex = ($i + 1) * $recordsPerGroup + $index + 1;
                $newCamp = Camp::find($newIndex);
                
                if ($newCamp) {
                    // 복사할 필드를 선택적으로 지정하여 업데이트
                    $newCamp->tel = $camp->tel;
                    $newCamp->link = $camp->link;
                    $newCamp->main_img = $camp->main_img;
                    $newCamp->other_img_1 = $camp->other_img_1;
                    $newCamp->other_img_2 = $camp->other_img_2;
                    $newCamp->other_img_3 = $camp->other_img_3;
                    $newCamp->other_img_4 = $camp->other_img_4;
                    $newCamp->other_img_5 = $camp->other_img_5;
                    $newCamp->other_img_6 = $camp->other_img_6;
                    
                    $newCamp->save();
                    echo "Updated record $newIndex\n";
                } else {
                    echo "Record $newIndex not found\n";
                }
            }
        }
        
        echo "Update process completed.\n";
    }
}
