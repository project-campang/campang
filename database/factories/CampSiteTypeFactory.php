<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\camp_site_type>
 */
class CampSiteTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'camp_id' => $this->faker->numberBetween($min = 1, $max = 2279)
            ,'site_type_no' => $this->faker->numberBetween($min = 1, $max = 7)
            ,'cnt'=> $this->faker->numberBetween($min = 1, $max = 10)
        ];
    }
}
