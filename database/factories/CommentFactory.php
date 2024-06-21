<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'camp_id' => $this->faker->numberBetween($min = 1, $max = 200)
            ,'user_id' => $this->faker->numberBetween($min = 1, $max = 3)
            ,'comment' => $this->faker->realText(rand(10,200))
        ];
    }
}
