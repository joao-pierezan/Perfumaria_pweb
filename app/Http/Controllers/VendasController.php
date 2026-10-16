<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venda;
use App\Models\Usuario;
use App\Models\Perfume;

class VendasController extends Controller
{
    public function index()
    {
        $a = Venda::with(['perfume', 'usuario'])->get();
        return view('vendas.list', compact('a'));
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

    public function store(Request $request)
    {
        $request->validate([
            'perfume_id'  => 'required',
            'usuario_id'  => 'required',
            'valor_total' => 'required|numeric',
        ]);

        Venda::create($request->all());

        return redirect()->route('vendas.index')->with('success', 'Registo criado com sucesso!');
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
        $request->validate([
            'perfume_id'  => 'required',
            'usuario_id'  => 'required',
            'valor_total' => 'required|numeric',
        ]);

        $a = Venda::findOrFail($id);
        $a->update($request->all());

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