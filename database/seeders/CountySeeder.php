<?php

namespace Database\Seeders;

use App\Models\County;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        County::create(['name' => '강남구', 'state_id' => 1]);
        County::create(['name' => '강동구', 'state_id' => 1]);
        County::create(['name' => '강북구', 'state_id' => 1]);
        County::create(['name' => '강서구', 'state_id' => 1]);
        County::create(['name' => '관악구', 'state_id' => 1]);
        County::create(['name' => '광진구', 'state_id' => 1]);
        County::create(['name' => '구로구', 'state_id' => 1]);
        County::create(['name' => '금천구', 'state_id' => 1]);
        County::create(['name' => '노원구', 'state_id' => 1]);
        County::create(['name' => '도봉구', 'state_id' => 1]);
        County::create(['name' => '동대문구', 'state_id' => 1]);
        County::create(['name' => '동작구', 'state_id' => 1]);
        County::create(['name' => '마포구', 'state_id' => 1]);
        County::create(['name' => '서대문구', 'state_id' => 1]);
        County::create(['name' => '서초구', 'state_id' => 1]);
        County::create(['name' => '성동구', 'state_id' => 1]);
        County::create(['name' => '성북구', 'state_id' => 1]);
        County::create(['name' => '송파구', 'state_id' => 1]);
        County::create(['name' => '양천구', 'state_id' => 1]);
        County::create(['name' => '영등포구', 'state_id' => 1]);
        County::create(['name' => '용산구', 'state_id' => 1]);
        County::create(['name' => '은평구', 'state_id' => 1]);
        County::create(['name' => '종로구', 'state_id' => 1]);
        County::create(['name' => '중구', 'state_id' => 1]);
        County::create(['name' => '중랑구', 'state_id' => 1]);
        
        County::create(['name' => '강서구', 'state_id' => 2]);
        County::create(['name' => '금정구', 'state_id' => 2]);
        County::create(['name' => '남구', 'state_id' => 2]);
        County::create(['name' => '동구', 'state_id' => 2]);
        County::create(['name' => '동래구', 'state_id' => 2]);
        County::create(['name' => '부산진구', 'state_id' => 2]);
        County::create(['name' => '북구', 'state_id' => 2]);
        County::create(['name' => '사상구', 'state_id' => 2]);
        County::create(['name' => '사하구', 'state_id' => 2]);
        County::create(['name' => '서구', 'state_id' => 2]);
        County::create(['name' => '수영구', 'state_id' => 2]);
        County::create(['name' => '연제구', 'state_id' => 2]);
        County::create(['name' => '영도구', 'state_id' => 2]);
        County::create(['name' => '중구', 'state_id' => 2]);
        County::create(['name' => '해운대구', 'state_id' => 2]);
        County::create(['name' => '기장군', 'state_id' => 2]);
        
        County::create(['name' => '남구', 'state_id' => 3]);
        County::create(['name' => '달서구', 'state_id' => 3]);
        County::create(['name' => '동구', 'state_id' => 3]);
        County::create(['name' => '북구', 'state_id' => 3]);
        County::create(['name' => '서구', 'state_id' => 3]);
        County::create(['name' => '수성구', 'state_id' => 3]);
        County::create(['name' => '중구', 'state_id' => 3]);
        County::create(['name' => '달성군', 'state_id' => 3]);
        
        County::create(['name' => '계양구', 'state_id' => 4]);
        County::create(['name' => '남구', 'state_id' => 4]);
        County::create(['name' => '남동구', 'state_id' => 4]);
        County::create(['name' => '동구', 'state_id' => 4]);
        County::create(['name' => '부평구', 'state_id' => 4]);
        County::create(['name' => '서구', 'state_id' => 4]);
        County::create(['name' => '연수구', 'state_id' => 4]);
        County::create(['name' => '중구', 'state_id' => 4]);
        County::create(['name' => '강화군', 'state_id' => 4]);
        County::create(['name' => '옹진군', 'state_id' => 4]);
        
        County::create(['name' => '광산구', 'state_id' => 5]);
        County::create(['name' => '남구', 'state_id' => 5]);
        County::create(['name' => '동구', 'state_id' => 5]);
        County::create(['name' => '북구', 'state_id' => 5]);
        County::create(['name' => '서구', 'state_id' => 5]);
        
        County::create(['name' => '대덕구', 'state_id' => 6]);
        County::create(['name' => '동구', 'state_id' => 6]);
        County::create(['name' => '서구', 'state_id' => 6]);
        County::create(['name' => '유성구', 'state_id' => 6]);
        County::create(['name' => '중구', 'state_id' => 6]);
        
        County::create(['name' => '남구', 'state_id' => 7]);
        County::create(['name' => '동구', 'state_id' => 7]);
        County::create(['name' => '북구', 'state_id' => 7]);
        County::create(['name' => '중구', 'state_id' => 7]);
        County::create(['name' => '울주군', 'state_id' => 7]);
        
        County::create(['name' => '금남면', 'state_id' => 8]);
        County::create(['name' => '소정면', 'state_id' => 8]);
        County::create(['name' => '연서면', 'state_id' => 8]);
        County::create(['name' => '전동면', 'state_id' => 8]);
        
        County::create(['name' => '고양시', 'state_id' => 9]);
        County::create(['name' => '과천시', 'state_id' => 9]);
        County::create(['name' => '광명시', 'state_id' => 9]);
        County::create(['name' => '구리시', 'state_id' => 9]);
        County::create(['name' => '군포시', 'state_id' => 9]);
        County::create(['name' => '남양주시', 'state_id' => 9]);
        County::create(['name' => '동두천시', 'state_id' => 9]);
        County::create(['name' => '부천시', 'state_id' => 9]);
        County::create(['name' => '성남시', 'state_id' => 9]);
        County::create(['name' => '수원시', 'state_id' => 9]);
        County::create(['name' => '시흥시', 'state_id' => 9]);
        County::create(['name' => '안산시', 'state_id' => 9]);
        County::create(['name' => '안양시', 'state_id' => 9]);
        County::create(['name' => '오산시', 'state_id' => 9]);
        County::create(['name' => '용인시', 'state_id' => 9]);
        County::create(['name' => '의왕시', 'state_id' => 9]);
        County::create(['name' => '의정부시', 'state_id' => 9]);
        County::create(['name' => '평택시', 'state_id' => 9]);
        County::create(['name' => '하남시', 'state_id' => 9]);
        County::create(['name' => '광주시', 'state_id' => 9]);
        County::create(['name' => '김포시', 'state_id' => 9]);
        County::create(['name' => '안성시', 'state_id' => 9]);
        County::create(['name' => '파주시', 'state_id' => 9]);
        County::create(['name' => '포천시', 'state_id' => 9]);
        County::create(['name' => '화성시', 'state_id' => 9]);        
        County::create(['name' => '가평군', 'state_id' => 9]);
        County::create(['name' => '양주군', 'state_id' => 9]);
        County::create(['name' => '양평군', 'state_id' => 9]);
        County::create(['name' => '여주군', 'state_id' => 9]);
        County::create(['name' => '연천군', 'state_id' => 9]);
        County::create(['name' => '이천군', 'state_id' => 9]);

        County::create(['name' => '강릉시', 'state_id' => 10]);
        County::create(['name' => '동해시', 'state_id' => 10]);
        County::create(['name' => '삼척시', 'state_id' => 10]);
        County::create(['name' => '속초시', 'state_id' => 10]);
        County::create(['name' => '원주시', 'state_id' => 10]);
        County::create(['name' => '춘천시', 'state_id' => 10]);
        County::create(['name' => '태백시', 'state_id' => 10]);
        County::create(['name' => '고성군', 'state_id' => 10]);
        County::create(['name' => '양구군', 'state_id' => 10]);
        County::create(['name' => '양양군', 'state_id' => 10]);
        County::create(['name' => '영월군', 'state_id' => 10]);
        County::create(['name' => '인제군', 'state_id' => 10]);
        County::create(['name' => '정선군', 'state_id' => 10]);
        County::create(['name' => '철원군', 'state_id' => 10]);
        County::create(['name' => '평창군', 'state_id' => 10]);
        County::create(['name' => '홍천군', 'state_id' => 10]);
        County::create(['name' => '화천군', 'state_id' => 10]);

        County::create(['name' => '제천시', 'state_id' => 11]);
        County::create(['name' => '청주시', 'state_id' => 11]);
        County::create(['name' => '충주시', 'state_id' => 11]);
        County::create(['name' => '괴산군', 'state_id' => 11]);
        County::create(['name' => '단양군', 'state_id' => 11]);
        County::create(['name' => '보은군', 'state_id' => 11]);
        County::create(['name' => '영동군', 'state_id' => 11]);
        County::create(['name' => '옥천군', 'state_id' => 11]);
        County::create(['name' => '음성군', 'state_id' => 11]);
        County::create(['name' => '진천군', 'state_id' => 11]);
        County::create(['name' => '청원군', 'state_id' => 11]);

        County::create(['name' => '공주시', 'state_id' => 12]);
        County::create(['name' => '보령시', 'state_id' => 12]);
        County::create(['name' => '서산시', 'state_id' => 12]);
        County::create(['name' => '아산시', 'state_id' => 12]);
        County::create(['name' => '천안시', 'state_id' => 12]);
        County::create(['name' => '당진시', 'state_id' => 12]);
        County::create(['name' => '금산군', 'state_id' => 12]);
        County::create(['name' => '논산군', 'state_id' => 12]);
        County::create(['name' => '부여군', 'state_id' => 12]);
        County::create(['name' => '서천군', 'state_id' => 12]);
        County::create(['name' => '연기군', 'state_id' => 12]);
        County::create(['name' => '예산군', 'state_id' => 12]);
        County::create(['name' => '청양군', 'state_id' => 12]);
        County::create(['name' => '태안군', 'state_id' => 12]);
        County::create(['name' => '홍성군', 'state_id' => 12]);

        County::create(['name' => '군산시', 'state_id' => 13]);
        County::create(['name' => '김제시', 'state_id' => 13]);
        County::create(['name' => '남원시', 'state_id' => 13]);
        County::create(['name' => '익산시', 'state_id' => 13]);
        County::create(['name' => '전주시', 'state_id' => 13]);
        County::create(['name' => '정읍시', 'state_id' => 13]);
        County::create(['name' => '고창군', 'state_id' => 13]);
        County::create(['name' => '무주군', 'state_id' => 13]);
        County::create(['name' => '부안군', 'state_id' => 13]);
        County::create(['name' => '순창군', 'state_id' => 13]);
        County::create(['name' => '완주군', 'state_id' => 13]);
        County::create(['name' => '임실군', 'state_id' => 13]);
        County::create(['name' => '장수군', 'state_id' => 13]);
        County::create(['name' => '진안군', 'state_id' => 13]);

        County::create(['name' => '광양시', 'state_id' => 14]);
        County::create(['name' => '나주시', 'state_id' => 14]);
        County::create(['name' => '목포시', 'state_id' => 14]);
        County::create(['name' => '순천시', 'state_id' => 14]);
        County::create(['name' => '여수시', 'state_id' => 14]);
        County::create(['name' => '여천시', 'state_id' => 14]);
        County::create(['name' => '강진군', 'state_id' => 14]);
        County::create(['name' => '고흥군', 'state_id' => 14]);
        County::create(['name' => '곡성군', 'state_id' => 14]);
        County::create(['name' => '구례군', 'state_id' => 14]);
        County::create(['name' => '담양군', 'state_id' => 14]);
        County::create(['name' => '무안군', 'state_id' => 14]);
        County::create(['name' => '보성군', 'state_id' => 14]);
        County::create(['name' => '신안군', 'state_id' => 14]);
        County::create(['name' => '여천군', 'state_id' => 14]);
        County::create(['name' => '영광군', 'state_id' => 14]);
        County::create(['name' => '영암군', 'state_id' => 14]);
        County::create(['name' => '완도군', 'state_id' => 14]);
        County::create(['name' => '장성군', 'state_id' => 14]);
        County::create(['name' => '장흥군', 'state_id' => 14]);
        County::create(['name' => '진도군', 'state_id' => 14]);
        County::create(['name' => '함평군', 'state_id' => 14]);
        County::create(['name' => '해남군', 'state_id' => 14]);
        County::create(['name' => '화순군', 'state_id' => 14]);

        County::create(['name' => '경산시', 'state_id' => 15]);
        County::create(['name' => '경주시', 'state_id' => 15]);
        County::create(['name' => '구미시', 'state_id' => 15]);
        County::create(['name' => '김천시', 'state_id' => 15]);
        County::create(['name' => '문경시', 'state_id' => 15]);
        County::create(['name' => '상주시', 'state_id' => 15]);
        County::create(['name' => '안동시', 'state_id' => 15]);
        County::create(['name' => '영주시', 'state_id' => 15]);
        County::create(['name' => '영천시', 'state_id' => 15]);
        County::create(['name' => '포항시', 'state_id' => 15]);
        County::create(['name' => '고령군', 'state_id' => 15]);
        County::create(['name' => '군위군', 'state_id' => 15]);
        County::create(['name' => '봉화군', 'state_id' => 15]);
        County::create(['name' => '성주군', 'state_id' => 15]);
        County::create(['name' => '영덕군', 'state_id' => 15]);
        County::create(['name' => '영양군', 'state_id' => 15]);
        County::create(['name' => '예천군', 'state_id' => 15]);
        County::create(['name' => '울릉군', 'state_id' => 15]);
        County::create(['name' => '울진군', 'state_id' => 15]);
        County::create(['name' => '의성군', 'state_id' => 15]);
        County::create(['name' => '청도군', 'state_id' => 15]);
        County::create(['name' => '청송군', 'state_id' => 15]);
        County::create(['name' => '칠곡군', 'state_id' => 15]);

        County::create(['name' => '거제시', 'state_id' => 16]);
        County::create(['name' => '김해시', 'state_id' => 16]);
        County::create(['name' => '밀양시', 'state_id' => 16]);
        County::create(['name' => '사천시', 'state_id' => 16]);
        County::create(['name' => '양산시', 'state_id' => 16]);
        County::create(['name' => '진주시', 'state_id' => 16]);
        County::create(['name' => '창원시', 'state_id' => 16]);
        County::create(['name' => '통영시', 'state_id' => 16]);
        County::create(['name' => '거창군', 'state_id' => 16]);
        County::create(['name' => '고성군', 'state_id' => 16]);
        County::create(['name' => '남해군', 'state_id' => 16]);
        County::create(['name' => '산청군', 'state_id' => 16]);
        County::create(['name' => '의령군', 'state_id' => 16]);
        County::create(['name' => '창녕군', 'state_id' => 16]);
        County::create(['name' => '하동군', 'state_id' => 16]);
        County::create(['name' => '함안군', 'state_id' => 16]);
        County::create(['name' => '함양군', 'state_id' => 16]);
        County::create(['name' => '합천군', 'state_id' => 16]);

        County::create(['name' => '서귀포시', 'state_id' => 17]);
        County::create(['name' => '제주시', 'state_id' => 17]);

        // County::create($data);
    }
}
