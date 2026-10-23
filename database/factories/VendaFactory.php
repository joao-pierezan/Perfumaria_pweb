<?php

namespace Database\Factories;

use App\Models\Venda;
use App\Models\Perfume;
use App\Models\Usuario;
use App\Models\Avaliacao;
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
            'usuario_id'  => $usuario->id,
            'perfume_id'  => $perfume->id,
            'valor_total' => $perfume->preco,
        ];
    }

    /**
     * Configura callback pós-criação para garantir relação 1:1 total
     */
    public function configure()
    {
        return $this->afterCreating(function (Venda $venda) {
            if (!$venda->avaliacao()->exists()) {
                Avaliacao::create([
                    'venda_id'    => $venda->id,
                    'perfume'     => $venda->perfume_id,
                    'autor'       => $venda->usuario_id,
                    'nota'        => fake()->randomFloat(2, 0, 10),
                    'texto'       => fake()->text(200),
                    'longevidade' => fake()->randomElement(['curto', 'medio', 'longo']),
                ]);
            }
        });
    }
}
