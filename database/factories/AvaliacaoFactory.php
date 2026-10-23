<?php

namespace Database\Factories;

use App\Models\Avaliacao;
use App\Models\Usuario;
use App\Models\Perfume;
use App\Models\Venda;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Avaliacao>
 */
class AvaliacaoFactory extends Factory
{
    public function definition(): array
    {
        $perfume = Perfume::all()->isNotEmpty() ? Perfume::all()->random() : Perfume::factory()->create();
        $usuario = Usuario::all()->isNotEmpty() ? Usuario::all()->random() : Usuario::factory()->create();

        return [
            'perfume' => $perfume->id,
            'nota' => fake()->randomFloat(2, 0, 10),
            'texto' => fake()->text(200),
            'autor' => $usuario->id,
            'longevidade' => fake()->randomElement(['curto', 'medio', 'longo']),
            'venda_id' => function (array $attributes) use ($perfume, $usuario) {
                return Venda::create([
                    'perfume_id'  => $attributes['perfume'] ?? $perfume->id,
                    'usuario_id'  => $attributes['autor'] ?? $usuario->id,
                    'valor_total' => $perfume->preco ?? 100.00,
                ])->id;
            },
        ];
    }
}
