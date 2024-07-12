<?php

namespace Database\Seeders;

use App\Models\CampTopo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampTopoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CampTopo::factory(1000)->create();
    }
}
