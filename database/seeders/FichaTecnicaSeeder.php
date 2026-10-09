<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FichaTecnica;

class FichaTecnicaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FichaTecnica::factory(10)->create();
    }
}

