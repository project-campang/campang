<?php

namespace Database\Seeders;

use App\Models\Amusement;
use App\Models\CampAmusement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AmusementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Amusement::factory(10)->create();
    }
}
