<?php

namespace Database\Seeders;

use App\Models\CampAmusement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampAmusementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CampAmusement::factory(1000)->create();
    }
}
