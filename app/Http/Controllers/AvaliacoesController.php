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

        $dados = Avaliacao::with('usuario')->get();

        return view('avaliacoes.list')->with(['dados' => $dados]);
    }

    public function create()
        {
            $usuarios = Usuario::all();
            $perfumes = Perfume::all(); // 2. Busque os perfumes no banco
            $data = new Avaliacao();

            // 3. Inclua 'perfumes' no compact
            return view('avaliacoes.form', compact('usuarios', 'perfumes', 'data'));
        }

    public function validateForm(Request $request)
    {
        $request->validate([
            'perfume' => 'required',
            'nota' => 'required|numeric|min:0|max:10',
            'texto' => 'required',
            'autor' => 'required'
        ], [
            'perfume.required' => "O :attribute é obrigatório",
            'nota.required' => "A :attribute é obrigatória",
            'texto.required' => "A resenha é obrigatória",
            'autor.required' => "O autor é obrigatório"
        ]);
    }

    public function store(Request $request)
    {
        $this->validateForm($request);

        Avaliacao::create($request->all());

        return redirect('avaliacoes')->with("success", 'Registro salvo com sucesso!');
    }

    public function edit($id)
        {
            $data = Avaliacao::findOrFail($id);
            $usuarios = Usuario::all();
            $perfumes = Perfume::all(); // 2. Busque os perfumes ao editar também

            // 3. Inclua 'perfumes' no compact
            return view('avaliacoes.form', compact('data', 'usuarios', 'perfumes'));
        }

    // ...

    public function update(Request $request, $id)
    {
        $this->validateForm($request);

        Avaliacao::findOrFail($id)->update($request->all());

        return redirect('avaliacoes')->with("success", 'Registro atualizado com sucesso!');
    }

    public function destroy($id)
    {
        Avaliacao::destroy($id);

        return redirect('avaliacoes')->with("success", 'Registro removido com sucesso!');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Avaliacao::with('usuario')->where(
                $request->tipo,
                'like',
                "%$request->valor%"
            )->get();
        } else {
            $dados = Avaliacao::with('usuario')->get();
        }

        return view('avaliacoes.list', compact('dados'));
    }
}