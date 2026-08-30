<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avaliacao;

class AvaliacoesController extends Controller
{
    public function index()
    {
        $dados = Avaliacao::all();

        return view('avaliacoes.list')->with(['dados' => $dados]);
    }

    public function create()
    {
        return view('avaliacoes.form');
    }

    public function validateForm(Request $request)
    {
        $request->validate([
            'perfume' => 'required',
            'nota' => 'required',
            'texto' => 'required'
        ], [
            'perfume.required' => "O :attribute é obrigatorio",
            'nota.required' => "O :attribute é obrigatorio",
            'texto.required' => "O :attribute é obrigatorio"
        ]);
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $this->validateForm($request);

        Avaliacao::create($request->all());

        return redirect('avaliacoes')->with("success", 'Registro Salvo com sucesso!');
    }

    public function edit($id)
    {
        $data = Avaliacao::findOrFail($id);

        // dd($data);
        //return view('Perfume.form')->with(['data' => $data]);
        return view('avaliacoes.form', compact('data'));
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $this->validateForm($request);

        Avaliacao::findOrFail($id)->update($request->all());

        return redirect('avaliacoes')->with("success", 'Registro Atualizado com sucesso!');
    }

    public function destroy($id)
    {
        Avaliacao::destroy($id);

        return redirect('avaliacoes')->with("success", 'Registro removido com sucesso!');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Avaliacao::where(
                $request->tipo,
                'like',
                "%$request->valor%"
            )->get();
        } else {
            $dados = Avaliacao::all();
        }

        return view('avaliacoes.list', compact('dados'));
    }
}