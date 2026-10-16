<?php

namespace App\Http\Controllers;

use App\Models\Perfume;
use App\Models\Notas;
use App\Models\Avaliacao;
use App\Models\Venda;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $totalPerfumes = Perfume::count();
        $totalNotas = Notas::count();
        $totalAvaliacoes = Avaliacao::count();
        $totalVendas = Venda::count();

        // 4 perfumes em destaque para a vitrine
        $destaques = Perfume::with('notas')->take(4)->get();

        // 3 avaliações recentes
        $ultimasAvaliacoes = Avaliacao::with(['perfumeRelacionado', 'usuario'])->latest()->take(3)->get();

        return view('home.list', compact(
            'totalPerfumes',
            'totalNotas',
            'totalAvaliacoes',
            'totalVendas',
            'destaques',
            'ultimasAvaliacoes'
        ));
    }
}
