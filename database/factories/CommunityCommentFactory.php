<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommunityComment>
 */
class CommunityCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'community_id' => $this->faker->numberBetween(200,2000)
            ,'user_id' => $this->faker->numberBetween($min = 1, $max = 3)
            ,'comment' => $this->faker->realText(rand(10,200))
        ];
    }
}
