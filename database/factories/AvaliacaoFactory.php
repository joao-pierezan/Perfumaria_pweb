<?php

namespace Database\Factories;

use App\Models\Avaliacao;
use App\Models\Usuario; // Certifique-se de importar o MODEL aqui, não a UsuarioFactory
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Avaliacao>
 */
class AvaliacaoFactory extends Factory
{
    public function definition(): array
    {
        $marcas = ['Dior', 'Chanel', 'Tom Ford', 'Natura', 'O Boticário', 'Yves Saint Laurent', 'Carolina Herrera', 'Paco Rabanne'];
        $perfumes = ['Bleu de Chanel', 'Terre d Hermes', 'Acqua di Giò', 'Light Blue', 'CK One', 'La Vie Est Belle', 'J adore', 'Black Opium', 'Good Girl', 'One Million', 'Miss Dior', 'Chypre Coty', 'Coco Mademoiselle', 'Sauvage', 'Cool Water', 'Angel', 'Scandal', 'Acqua di Giò Profumo', 'Kenzo Homme', 'Invictus'];

        return [
            'perfume' => fake()->randomElement($marcas) . ' ' . fake()->randomElement($perfumes),
            'nota' => fake()->randomFloat(2, 0, 10),
            'texto' => fake()->text(200),
            'autor' => Usuario::inRandomOrder()->first()?->id ?? Usuario::factory(),
        ];
    }
}
