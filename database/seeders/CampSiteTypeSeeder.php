<?php

namespace Database\Seeders;

use App\Models\CampSiteType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampSiteTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CampSiteType::factory(1000)->create();
    }
}
