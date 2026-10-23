<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avaliacao;
use App\Models\Usuario;
use App\Models\Perfume;
use App\Models\Venda;

class AvaliacoesController extends Controller
{
    public function index()
    {
        $dados = Avaliacao::with(['usuario', 'perfumeRelacionado', 'venda'])->get();
        return view('avaliacoes.list', compact('dados'));
    }

    public function create(Request $request)
    {
        $usuarios = Usuario::all();
        $perfumes = Perfume::all();
        $vendas = Venda::with(['perfume', 'usuario'])->get();
        $data = new Avaliacao();

        if ($request->filled('venda_id')) {
            $venda = Venda::find($request->venda_id);
            if ($venda) {
                $data->venda_id = $venda->id;
                $data->perfume = $venda->perfume_id;
                $data->autor = $venda->usuario_id;
            }
        } elseif ($request->filled('perfume_id')) {
            $data->perfume = $request->perfume_id;
        }

        return view('avaliacoes.form', compact('usuarios', 'perfumes', 'vendas', 'data'));
    }

    public function validateForm(Request $request, $id = null)
    {
        // Ajustado para 'perfume', 'autor' e 'venda_id' conforme o Model (relacionamento 1:1)
        $request->validate([
            'perfume'     => 'required',
            'nota'        => 'required|numeric|min:0|max:10',
            'texto'       => 'required',
            'autor'       => 'required',
            'longevidade' => 'required|in:curto,medio,longo',
            'venda_id'    => 'nullable|exists:vendas,id|unique:avaliacoes,venda_id,' . $id,
        ], [
            'perfume.required'     => "O perfume é obrigatório",
            'nota.required'        => "A nota é obrigatória",
            'texto.required'       => "A resenha é obrigatória",
            'autor.required'       => "O autor é obrigatório",
            'longevidade.required' => "A longevidade é obrigatória",
            'venda_id.exists'      => "A venda informada não existe",
            'venda_id.unique'      => "Esta venda já possui uma avaliação vinculada (relacionamento 1:1)",
        ]);
    }

    public function store(Request $request)
    {
        $this->validateForm($request);

        $perfumeId = $request->perfume;
        $data = $request->all();

        if (empty($data['venda_id'])) {
            $data['venda_id'] = null;
        }

        Avaliacao::create($data);
        
        return redirect('perfume/' . $perfumeId)->with("success", 'Registro salvo com sucesso!');
    }

    public function edit($id)
    {
        $data = Avaliacao::findOrFail($id);
        $usuarios = Usuario::all();
        $perfumes = Perfume::all();
        $vendas = Venda::with(['perfume', 'usuario'])->get();
        return view('avaliacoes.form', compact('data', 'usuarios', 'perfumes', 'vendas'));
    }

    public function update(Request $request, $id)
    {
        $this->validateForm($request, $id);

        Avaliacao::findOrFail($id)->update($request->all());
        $perfumeId = $request->perfume;

        return redirect('perfume/' . $perfumeId)->with("success", 'Registro atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $avaliacao = Avaliacao::findOrFail($id);
        $perfumeId = $avaliacao->perfume;

        $avaliacao->delete();

        return redirect('perfume/' . $perfumeId)->with("success", 'Registro removido com sucesso!');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $valor = $request->valor;
            if ($request->tipo === 'perfume') {
                $dados = Avaliacao::with(['usuario', 'perfumeRelacionado', 'venda'])->whereHas(
                    'perfumeRelacionado',
                    function ($q) use ($valor) {
                        $q->where('nome', 'like', "%$valor%")
                          ->orWhere('marca', 'like', "%$valor%");
                    }
                )->get();
            } elseif ($request->tipo === 'autor') {
                $dados = Avaliacao::with(['usuario', 'perfumeRelacionado', 'venda'])->whereHas(
                    'usuario',
                    function ($q) use ($valor) {
                        $q->where('nome', 'like', "%$valor%");
                    }
                )->get();
            } else {
                $dados = Avaliacao::with(['usuario', 'perfumeRelacionado', 'venda'])->where(
                    $request->tipo,
                    'like',
                    "%$valor%"
                )->get();
            }
        } else {
            $dados = Avaliacao::with(['usuario', 'perfumeRelacionado', 'venda'])->get();
        }

        return view('avaliacoes.list', compact('dados'));
    }
}