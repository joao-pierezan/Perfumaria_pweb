<?php

namespace Database\Factories;

use App\Models\Notas;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Notas>
 */
class NotasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected static int $index = 0;

    protected static array $notasLista = [
        ['nome' => 'Jasmin', 'imagem' => 'imagensNotas/jasmin.jpg', 'descricao' => 'Flor branca doce, opulenta e inebriante.'],
        ['nome' => 'Violeta', 'imagem' => 'imagensNotas/violeta.jpg', 'descricao' => 'Nuance floral orvalhada e verde refinada.'],
        ['nome' => 'Maçã', 'imagem' => 'imagensNotas/maca.jpg', 'descricao' => 'Frutada, fresca, crocante e suculenta.'],
        ['nome' => 'Cardamomo', 'imagem' => 'imagensNotas/cardamomo.jpg', 'descricao' => 'Especiaria fresca e picante com nuances aromáticas.'],
        ['nome' => 'Couro', 'imagem' => 'imagensNotas/couro.jpg', 'descricao' => 'Nota imponente, seca, elegante e sofisticada.'],
        ['nome' => 'Pimenta', 'imagem' => 'imagensNotas/pimenta.jpg', 'descricao' => 'Especiaria picante, efervescente e estimulante.'],
        ['nome' => 'Canela', 'imagem' => 'imagensNotas/canela.jpg', 'descricao' => 'Nota quente, aromática e aconchegante.'],
        ['nome' => 'Tabaco', 'imagem' => 'imagensNotas/tabaco.jpg', 'descricao' => 'Quente, esfumaçada e levemente adocicada.'],
        ['nome' => 'Cedro', 'imagem' => 'imagensNotas/cedro.jpg', 'descricao' => 'Madeira seca, nobre e altamente estruturante.'],
        ['nome' => 'Rosa', 'imagem' => 'imagensNotas/rosa.jpg', 'descricao' => 'A rainha das flores, rica, romântica e aveludada.'],
        ['nome' => 'Notas Oceânicas', 'imagem' => 'imagensNotas/notasOceanicas.jpg', 'descricao' => 'Acorde aquático arejado e refrescante.'],
        ['nome' => 'Âmbar', 'imagem' => 'imagensNotas/ambar.jpg', 'descricao' => 'Resinosa, rica, quente e de aura dourada.'],
        ['nome' => 'Madeira', 'imagem' => 'imagensNotas/madeira.jpg', 'descricao' => 'Acorde amadeirado versátil e confortável.'],
        ['nome' => 'Íris', 'imagem' => 'imagensNotas/iris.jpg', 'descricao' => 'Flor nobre com notas atalcadas e aveludadas.'],
        ['nome' => 'Lavanda', 'imagem' => 'imagensNotas/lavanda.jpg', 'descricao' => 'Aroma limpo, herbal, relaxante e clássico.'],
        ['nome' => 'Almíscar', 'imagem' => 'imagensNotas/almiscar.jpg', 'descricao' => 'Aveludada, sensual, limpa e de grande fixação.'],
        ['nome' => 'Bergamota', 'imagem' => 'imagensNotas/bergamota.jpg', 'descricao' => 'Cítrico nobre, solar, vibrante e ligeiramente floral.'],
        ['nome' => 'Limão', 'imagem' => 'imagensNotas/limao.jpg', 'descricao' => 'Cítrico efervescente, refrescante e revigorante.'],
        ['nome' => 'Baunilha', 'imagem' => 'imagensNotas/baunilha.webp', 'descricao' => 'Doce, cremosa, envolvente e aconchegante.'],
        ['nome' => 'Menta', 'imagem' => 'imagensNotas/menta.jpg', 'descricao' => 'Frescor gelado, dinâmico e revigorante.'],
    ];

    public function definition(): array
    {
        $total = count(self::$notasLista);
        $nota = self::$notasLista[self::$index % $total];
        self::$index++;

        return [
            'imagem' => $nota['imagem'],
            'nome' => $nota['nome'],
            'descricao' => $nota['descricao'],
        ];
    }
}
