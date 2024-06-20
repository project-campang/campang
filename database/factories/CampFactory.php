<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Camp>
 */
class CampFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => '어거스트캠핑장',
            'tel' => '010-0000-0000',
            'address' => '경기 포천시 가산면 우금3길 142-29',
            'state' => '경기도',
            'country' => '포천시',
            'latitude' => 37.8181789,
            'longitude' => 127.2275313,
            'info_text' => '엄청엄청 좋은 캠핑장입니다',
            'max_capacity' => 10,
            'main_img' => '/img_nr/캠핑장1.png',
        ];
    }
}
