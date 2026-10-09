<?php

namespace Database\Factories;

use App\Models\Avaliacao;
use App\Models\Usuario; // Certifique-se de importar o MODEL aqui, não a UsuarioFactory
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Perfume;

/**
 * @extends Factory<Avaliacao>
 */
class AvaliacaoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'perfume' =>  Perfume::inRandomOrder()->first()?->id ?? Perfume::factory(),
            'nota' => fake()->randomFloat(2, 0, 10),
            'texto' => fake()->text(200),
            'autor' => Usuario::inRandomOrder()->first()?->id ?? Usuario::factory(),
        ];
    }
}
