<?php

namespace Database\Factories;

use App\Models\FichaTecnica;
use Illuminate\Database\Eloquent\Factories\Factory;

class FichaTecnicaFactory extends Factory
{
    protected $model = FichaTecnica::class;

    public function definition(): array
    {
        $listaNotas = [
            'Bergamota', 'Limão Siciliano', 'Lavanda', 'Pimenta Rosa', 'Mandarina', 
            'Jasmim', 'Rosa', 'Flor de Laranjeira', 'Canela', 'Gerânio', 
            'Baunilha', 'Âmbar', 'Sândalo', 'Musk', 'Patchouli', 'Cedro', 'Fava Tonka'
        ];

        $geraNotasAleatorias = function() use ($listaNotas) {
            $quantidade = rand(1, 3);
            $notasSorteadas = fake()->randomElements($listaNotas, $quantidade);
            return implode(', ', $notasSorteadas);
        };

        return [
            'notas_topo' => $geraNotasAleatorias(),
            'notas_coracao' => $geraNotasAleatorias(),
            'notas_base' => $geraNotasAleatorias(),
        ];
    }
}