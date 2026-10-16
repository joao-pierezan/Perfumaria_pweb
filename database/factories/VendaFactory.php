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
        $perfume = Perfume::all()->isNotEmpty() ? Perfume::all()->random() : Perfume::factory()->create();
        $usuario = Usuario::all()->isNotEmpty() ? Usuario::all()->random() : Usuario::factory()->create();

        return [
            'usuario_id' => $usuario->id,
            'perfume_id' => $perfume->id,
            'valor_total' => $perfume->preco,
        ];
    }
}
