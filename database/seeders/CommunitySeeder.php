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
        Community::factory(50)->create();
        //  // 이미 들어있는 데이터의 범위를 지정합니다.
        //  $startId = 78;
        //  $endId = 577;
 
        //  // 복사할 데이터를 선택합니다.
        //  $recordsToCopy = Community::whereBetween('id', [$startId, $endId])->get();
 
        //  // 원하는 레코드 수만큼 반복해서 새로운 데이터를 생성합니다.
        //  $desiredRecordCount = 50;
        //  $createdRecords = 0;
 
        //  while ($createdRecords < $desiredRecordCount) {
        //      foreach ($recordsToCopy as $record) {
        //          Community::create([
        //              'title' => $record->title,
        //              'content' => $record->content,
        //              'main_img' => $record->main_img,
        //              'other_img2' => $record->other_img2,
        //              'other_img3' => $record->other_img3,
        //              'other_img4' => $record->other_img4,
        //              'views' => rand(10, 400),
        //              'type' => $record->type,
        //              'rating' => rand(2, 5),
        //              'user_id' => rand(31, 42), // 31부터 42 사이의 랜덤한 user_id
        //              'camp_id' => rand(1, 50), // 1부터 2250 사이의 랜덤한 camp_id
        //          ]);
 
        //          $createdRecords++;
 
        //          // 원하는 레코드 수를 초과하지 않도록 체크합니다.
        //          if ($createdRecords >= $desiredRecordCount) {
        //              break;
        //          }
        //      }
        //  }
    }
}
