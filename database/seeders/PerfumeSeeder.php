<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Perfume;

class PerfumeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Perfume::factory(15)->create();
    }
}
