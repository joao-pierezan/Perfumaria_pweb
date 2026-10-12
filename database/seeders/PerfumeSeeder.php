<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Perfume;
use App\Models\Notas;

class PerfumeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $todasNotas = Notas::all();

        Perfume::factory(15)->create()->each(function ($perfume) use ($todasNotas) {
            if ($todasNotas->count() >= 9) {
                $embaralhadas = $todasNotas->shuffle();

                $topNotas = $embaralhadas->slice(0, 3);
                $midNotas = $embaralhadas->slice(3, 2);
                $baseNotas = $embaralhadas->slice(5, 4);

                foreach ($topNotas as $nota) {
                    $perfume->notas()->attach($nota->id, ['tipo' => 'topo']);
                }

                foreach ($midNotas as $nota) {
                    $perfume->notas()->attach($nota->id, ['tipo' => 'coracao']);
                }

                foreach ($baseNotas as $nota) {
                    $perfume->notas()->attach($nota->id, ['tipo' => 'fundo']);
                }
            }
        });
    }
}
