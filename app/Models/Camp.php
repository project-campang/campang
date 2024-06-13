<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camp extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     * 갱신 가능한 컬럼 선언
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'tel',
        'address',
        'state',
        'country',
        'latitude',
        'longitude',
        'info_text',
        'max_capacity',
        'main_img',
        'other_img_1',
        'other_img_2',
        'other_img_3',
        'other_img_4',
        'other_img_5',
        'other_img_6',
        'other_img_7',
        'other_img_8',
        'other_img_9',
        'other_img_10',
    ];

    /**
     * TimeZone format when serializing JSON
     * JSON으로 시리얼라이즈 할때, 날짜를 원하는 형식으로 포맷
     * 이 메소드가 없으면 디폴트는 UTC
     * 
     * UTC기준으로 바뀌지 않도록 세팅하는 것
     * 
     * @param \DateTimeInterface $date
     * 
     * @return String('Y-m-d H:i:s')
     */
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
