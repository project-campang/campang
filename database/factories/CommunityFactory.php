<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use IntlChar;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Community>
 */
class CommunityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // return [
        //     'user_id' => 1,
        //     'type' => 1,
        //     'title' => $this->faker->realText(rand(10,50)),
        //     'content' => $this->faker->realText(rand(10,500)),
        //     'main_img' => '/img/sample1.jpg',
        //     'views' => rand(1,300),
        //     'rating' => rand(1,5),
        // ];
        return [
            'user_id' =>$this->faker->numberBetween(1, 3),
            'type' => 2,
            'title' => $this->faker->realText(rand(10,50)),
            'content' => $this->faker->realText(rand(10,500)),
            'main_img' => '/img/sample1.jpg',
            'views' => rand(1,300),
        ];

    }
}
