<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venda;
use App\Models\Usuario;
use App\Models\Perfume;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class VendasController extends Controller
{
    public function index()
    {
        $a = Venda::with(['perfume', 'usuario'])->get();
        $dados = $a;

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
                ->setSubtitle('Distribuição percentual das vendas por marca')
                ->addData($totais)
                ->setLabels($marcas);
        }

        return view('vendas.list', compact('a', 'dados', 'chart'));
    }

    public function chart()
    {
        $vendasPorMarca = Venda::join('perfumes', 'vendas.perfume_id', '=', 'perfumes.id')
            ->selectRaw('perfumes.marca, count(vendas.id) as total_vendas, sum(vendas.valor_total) as total_valor')
            ->groupBy('perfumes.marca')
            ->orderByDesc('total_vendas')
            ->get();

        $marcas = $vendasPorMarca->pluck('marca')->toArray();
        $totais = $vendasPorMarca->pluck('total_vendas')->map(fn($v) => (int)$v)->toArray();

        $chart = (new LarapexChart)->pieChart()
            ->setTitle('Vendas por Marca')
            ->setSubtitle('Distribuição da quantidade de vendas por marca de perfume')
            ->addData($totais)
            ->setLabels($marcas);

        return view('vendas.chart', compact('chart', 'vendasPorMarca'));
    }

    public function create(Request $request)
    {
        $a = new Venda();         // Nova venda vazia
        $b = Perfume::all(); // Lista de perfumes
        $c = Usuario::all(); // Lista de usuários

        // Correção: usa $request->has() e atribui a perfume_id
        if ($request->has('perfume_id')) {
            $a->perfume_id = $request->perfume_id; 
        }
        $perfume = Perfume::find($request->perfume_id);
        if ($perfume) {
            $a->valor_total = $perfume->preco;
        }
        
        return view('vendas.form', compact('a', 'b', 'c'));
    }

    public function validateForm(Request $request)
    {
        $perfumes = $request->input('perfumes');
        if (empty($perfumes) && $request->filled('perfume_id')) {
            $perfumes = [$request->input('perfume_id')];
        }

        $perfumes = array_filter((array) $perfumes);
        $request->merge(['perfumes' => $perfumes]);

        $request->validate([
            'perfumes'    => 'required|array|min:1',
            'perfumes.*'  => 'exists:perfumes,id',
            'usuario_id'  => 'required|exists:usuarios,id',
            'valor_total' => 'required|numeric',
        ], [
            'perfumes.required'    => 'O :attribute é obrigatório. Selecione pelo menos um perfume.',
            'usuario_id.required'  => 'O :attribute é obrigatório.',
            'valor_total.required' => 'O :attribute é obrigatório.',
        ]);
    }

    public function store(Request $request)
    {
        $this->validateForm($request);

        $perfumes = $request->input('perfumes');
        $usuarioId = $request->input('usuario_id');

        // Cria uma venda para cada perfume selecionado
        foreach ($perfumes as $perfumeId) {
            $perfume = Perfume::find($perfumeId);
            Venda::create([
                'perfume_id'  => $perfumeId,
                'usuario_id'  => $usuarioId,
                'valor_total' => $perfume ? $perfume->preco : 0,
            ]);
        }

        $mensagem = count($perfumes) > 1
            ? count($perfumes) . ' vendas registradas com sucesso!'
            : 'Venda registrada com sucesso!';

        return redirect()->route('vendas.index')->with('success', $mensagem);
    }

    public function edit($id)
    {
        $a = Venda::findOrFail($id); // A venda a ser editada
        $b = Perfume::all();         // Lista de perfumes
        $c = Usuario::all();         // Lista de usuários

        return view('vendas.form', compact('a', 'b', 'c'));
    }

    public function update(Request $request, $id)
    {
        $perfumes = $request->input('perfumes');
        if (empty($perfumes) && $request->filled('perfume_id')) {
            $perfumes = [$request->input('perfume_id')];
        }

        if (!empty($perfumes)) {
            $this->validateForm($request);
            $perfumeId = is_array($perfumes) ? reset($perfumes) : $perfumes;
        } else {
            $request->validate([
                'usuario_id'  => 'required|exists:usuarios,id',
                'valor_total' => 'required|numeric',
            ], [
                'usuario_id.required'  => 'O :attribute é obrigatório.',
                'valor_total.required' => 'O :attribute é obrigatório.',
            ]);
            $perfumeId = $request->input('perfume_id');
        }

        $a = Venda::findOrFail($id);
        $perfume = Perfume::find($perfumeId);

        $a->update([
            'perfume_id'  => $perfumeId ?: $a->perfume_id,
            'usuario_id'  => $request->input('usuario_id'),
            'valor_total' => $request->input('valor_total', $perfume ? $perfume->preco : $a->valor_total),
        ]);

        return redirect()->route('vendas.index')->with('success', 'Atualizado com sucesso!');
    }

    public function destroy($id)
    {
        Venda::destroy($id);
        return redirect()->route('vendas.index')->with('success', 'Removido com sucesso!');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $valor = $request->valor;
            $a = Venda::with(['perfume', 'usuario'])->whereHas('perfume', function ($q) use ($valor) {
                $q->where('nome', 'like', "%$valor%");
            })->get();
        } else {
            $a = Venda::with(['perfume', 'usuario'])->get();
        }

        return view('vendas.list', compact('a'));
    }
}