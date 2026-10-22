<?php

namespace Database\Factories;

use App\Models\Avaliacao;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Perfume;

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
        ];
    }
}
