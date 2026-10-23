<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Venda;
use App\Models\Avaliacao;

class AvaliacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Garante que qualquer venda sem avaliação receba uma avaliação 1:1
        $vendasSemAvaliacao = Venda::doesntHave('avaliacao')->get();
        foreach ($vendasSemAvaliacao as $venda) {
            Avaliacao::create([
                'venda_id'    => $venda->id,
                'perfume'     => $venda->perfume_id,
                'autor'       => $venda->usuario_id,
                'nota'        => fake()->randomFloat(2, 0, 10),
                'texto'       => fake()->text(200),
                'longevidade' => fake()->randomElement(['curto', 'medio', 'longo']),
            ]);
        }
    }
}
