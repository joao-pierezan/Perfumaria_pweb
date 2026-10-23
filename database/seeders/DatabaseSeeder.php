<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsuarioSeeder::class,
            NotasSeeder::class,
            PerfumeSeeder::class,
            VendasSeeder::class,
            AvaliacaoSeeder::class,
        ]);
    }
}
