<?php

namespace App\Http\Controllers;

use App\Models\Perfume;
use App\Models\Notas;
use App\Models\Avaliacao;
use App\Models\Venda;
use ArielMejiaDev\LarapexCharts\LarapexChart;
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

        // Gráfico de pizza de vendas por marca
        $vendasPorMarca = Venda::join('perfumes', 'vendas.perfume_id', '=', 'perfumes.id')
            ->selectRaw('perfumes.marca, count(vendas.id) as total_vendas')
            ->groupBy('perfumes.marca')
            ->orderByDesc('total_vendas')
            ->get();

        $marcas = $vendasPorMarca->pluck('marca')->toArray();
        $totais = $vendasPorMarca->pluck('total_vendas')->map(fn($v) => (int)$v)->toArray();

        $chart = null;
        if (!empty($totais)) {
            $chart = (new LarapexChart)->pieChart()
                ->setTitle('Vendas por Marca')
                ->setSubtitle('Proporção de pedidos por marca de perfume')
                ->addData($totais)
                ->setLabels($marcas);
        }

        return view('home.list', compact(
            'totalPerfumes',
            'totalNotas',
            'totalAvaliacoes',
            'totalVendas',
            'destaques',
            'ultimasAvaliacoes',
            'chart'
        ));
    }
}
