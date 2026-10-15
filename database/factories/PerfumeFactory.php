<?php

namespace Database\Factories;

use App\Models\Perfume;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Perfume>
 */
class PerfumeFactory extends Factory
{
    public function definition(): array
    {   
        $a=random_int(0,9);
        $nome = ['Aventus', 'Bleu de Channel', 'Chrome', 'Cool Water', 'Dylan Blue', 'Eros', 'Green Irish Tweed', 'Homme Intense', 'Le Male Elixir', 'Le Male Le Parfum', 'Pour Homme', 'Sauvage', 'Spicebomb', 'Stronger With You Intensely', 'Voyage'];
        $marcas = ['Dior', 'Chanel', 'Tom Ford', 'Natura', 'O Boticario', 'Yves Saint Laurent', 'Carolina Herrera', 'Paco Rabanne'];
        $familias = ['Amadeirado', 'Cítrico', 'Floral', 'Oriental', 'Chipre', 'Aromático', 'Gourmand', 'Aquático'];
        $volumes = ['30ml', '50ml', '75ml', '100ml', '200ml'];

        return [
            'nome' => $nome[$a],
            'marca' => fake()->randomElement($marcas),
            'familia_olfativa' => fake()->randomElement($familias),
            'preco' => fake()->randomFloat(2, 90, 1500),
            'volume' => fake()->randomElement($volumes),
            'imagem' => $nome[$a].'.avif',
        ];
    }
}
