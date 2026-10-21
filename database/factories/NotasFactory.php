<?php

namespace Database\Factories;

use App\Models\Notas;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotasFactory extends Factory
{
    public static int $index = 0;

    protected static array $notasLista = [
        ['nome' => 'Jasmin', 'imagem' => 'notas/jasmin.jpg', 'descricao' => 'Flor branca doce, opulenta e inebriante.'],
        ['nome' => 'Violeta', 'imagem' => 'notas/violeta.jpg', 'descricao' => 'Nuance floral orvalhada e verde refinada.'],
        ['nome' => 'Maçã', 'imagem' => 'notas/maca.jpg', 'descricao' => 'Frutada, fresca, crocante e suculenta.'],
        ['nome' => 'Cardamomo', 'imagem' => 'notas/cardamomo.jpg', 'descricao' => 'Especiaria fresca e picante com nuances aromáticas.'],
        ['nome' => 'Couro', 'imagem' => 'notas/couro.jpg', 'descricao' => 'Nota imponente, seca, elegante e sofisticada.'],
        ['nome' => 'Pimenta', 'imagem' => 'notas/pimenta.jpg', 'descricao' => 'Especiaria picante, efervescente e estimulante.'],
        ['nome' => 'Canela', 'imagem' => 'notas/canela.jpg', 'descricao' => 'Nota quente, aromática e aconchegante.'],
        ['nome' => 'Tabaco', 'imagem' => 'notas/tabaco.jpg', 'descricao' => 'Quente, esfumaçada e levemente adocicada.'],
        ['nome' => 'Cedro', 'imagem' => 'notas/cedro.jpg', 'descricao' => 'Madeira seca, nobre e altamente estruturante.'],
        ['nome' => 'Rosa', 'imagem' => 'notas/rosa.jpg', 'descricao' => 'A rainha das flores, rica, romântica e aveludada.'],
        ['nome' => 'Notas Oceânicas', 'imagem' => 'notas/notasOceanicas.jpg', 'descricao' => 'Acorde aquático arejado e refrescante.'],
        ['nome' => 'Âmbar', 'imagem' => 'notas/ambar.jpg', 'descricao' => 'Resinosa, rica, quente e de aura dourada.'],
        ['nome' => 'Madeira', 'imagem' => 'notas/madeira.jpg', 'descricao' => 'Acorde amadeirado versátil e confortável.'],
        ['nome' => 'Íris', 'imagem' => 'notas/iris.jpg', 'descricao' => 'Flor nobre com notas atalcadas e aveludadas.'],
        ['nome' => 'Lavanda', 'imagem' => 'notas/lavanda.jpg', 'descricao' => 'Aroma limpo, herbal, relaxante e clássico.'],
        ['nome' => 'Almíscar', 'imagem' => 'notas/almiscar.jpg', 'descricao' => 'Aveludada, sensual, limpa e de grande fixação.'],
        ['nome' => 'Bergamota', 'imagem' => 'notas/bergamota.jpg', 'descricao' => 'Cítrico nobre, solar, vibrante e ligeiramente floral.'],
        ['nome' => 'Limão', 'imagem' => 'notas/limao.jpg', 'descricao' => 'Cítrico efervescente, refrescante e revigorante.'],
        ['nome' => 'Baunilha', 'imagem' => 'notas/baunilha.webp', 'descricao' => 'Doce, cremosa, envolvente e aconchegante.'],
        ['nome' => 'Menta', 'imagem' => 'notas/menta.jpg', 'descricao' => 'Frescor gelado, dinâmico e revigorante.'],
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