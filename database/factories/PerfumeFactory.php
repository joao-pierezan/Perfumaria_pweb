<?php

namespace Database\Factories;

use App\Models\Perfume;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\FichaTecnica;

/**
 * @extends Factory<Perfume>
 */
class PerfumeFactory extends Factory
{
    public function definition(): array
    {
        $marcas = ['Dior', 'Chanel', 'Tom Ford', 'Natura', 'O Boticário', 'Yves Saint Laurent', 'Carolina Herrera', 'Paco Rabanne'];
        $familias = ['Amadeirado', 'Cítrico', 'Floral', 'Oriental', 'Chipre', 'Aromático', 'Gourmand', 'Aquático'];
        $volumes = ['30ml', '50ml', '75ml', '100ml', '200ml'];

        return [
            'nome' => fake()->word(),
            'marca' => fake()->randomElement($marcas),
            'familia_olfativa' => fake()->randomElement($familias),
            'preco' => fake()->randomFloat(2, 90, 1500), // Gera valor entre 90.00 e 1500.00
            'volume' => fake()->randomElement($volumes),
            'ficha_tecnica_id' => FichaTecnica::factory(),
        ];
    }
}
