<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avaliacao;
use App\Models\Usuario;
use App\Models\Perfume;

class AvaliacoesController extends Controller
{
    public function index()
    {
        $dados = Avaliacao::with(['usuario', 'perfumeRelacionado'])->get();
        return view('avaliacoes.list', compact('dados'));
    }

    public function create(Request $request)
    {
        $usuarios = Usuario::all();
        $perfumes = Perfume::all();
        $data = new Avaliacao();

        $data->perfume = $request->perfume_id;

        return view('avaliacoes.form', compact('usuarios', 'perfumes', 'data'));
    }

    public function validateForm(Request $request)
    {
        // Ajustado para 'perfume' e 'autor' conforme o Model
        $request->validate([
            'perfume' => 'required',
            'nota' => 'required|numeric|min:0|max:10',
            'texto' => 'required',
            'autor' => 'required',
            'longevidade' => 'required|in:curto,medio,longo',
        ], [
            'perfume.required' => "O perfume é obrigatório",
            'nota.required' => "A nota é obrigatória",
            'texto.required' => "A resenha é obrigatória",
            'autor.required' => "O autor é obrigatório",
            'longevidade.required' => "A longevidade é obrigatória",
        ]);
    }

    public function store(Request $request)
    {
        $this->validateForm($request);

        // Apanha o ID do perfume pela variável 'perfume'
        $perfumeId = $request->perfume;

        // Como o fillable do model tem 'perfume' e 'autor', o create() funciona diretamente
        Avaliacao::create($request->all());
        
        return redirect('perfume/' . $perfumeId)->with("success", 'Registro salvo com sucesso!');
    }

    public function edit($id)
    {
        $data = Avaliacao::findOrFail($id);
        $usuarios = Usuario::all();
        $perfumes = Perfume::all();
        return view('avaliacoes.form', compact('data', 'usuarios', 'perfumes'));
    }

    public function update(Request $request, $id)
    {
        $this->validateForm($request);

        Avaliacao::findOrFail($id)->update($request->all());
        $perfumeId = $request->perfume;

        return redirect('perfume/' . $perfumeId)->with("success", 'Registro atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $avaliacao = Avaliacao::findOrFail($id);
        $perfumeId = $avaliacao->perfume; // Usa a coluna 'perfume'
        $avaliacao->delete();

        return redirect('perfume/' . $perfumeId)->with("success", 'Registro removido com sucesso!');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $valor = $request->valor;
            if ($request->tipo === 'perfume') {
                $dados = Avaliacao::with(['usuario', 'perfumeRelacionado'])->whereHas(
                    'perfumeRelacionado',
                    function ($q) use ($valor) {
                        $q->where('nome', 'like', "%$valor%")
                          ->orWhere('marca', 'like', "%$valor%");
                    }
                )->get();
            } elseif ($request->tipo === 'autor') {
                $dados = Avaliacao::with(['usuario', 'perfumeRelacionado'])->whereHas(
                    'usuario',
                    function ($q) use ($valor) {
                        $q->where('nome', 'like', "%$valor%");
                    }
                )->get();
            } else {
                $dados = Avaliacao::with(['usuario', 'perfumeRelacionado'])->where(
                    $request->tipo,
                    'like',
                    "%$valor%"
                )->get();
            }
        } else {
            $dados = Avaliacao::with(['usuario', 'perfumeRelacionado'])->get();
        }

        return view('perfume.show', compact('dados'));
    }
}