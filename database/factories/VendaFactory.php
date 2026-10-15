<?php

namespace Database\Factories;

use App\Models\Venda;
use App\Models\Perfume;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Venda>
 */
class VendaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'usuario_id'=>Usuario::factory(),
            'perfume_id'=>Perfume::factory(),
            'valor_total' => function (array $a) {
                $perfume = Perfume::find($a['perfume_id']);
                
                return $perfume->preco;
            },
        ];
    }
}
