<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perfume;
use App\Models\FichaTecnica;

class PerfumeController extends Controller
{
    public function index()
    {
        $dados = Perfume::with('fichaTecnica')->get();
        return view('perfume.list', compact('dados'));
    }

    public function create()
    {
        $fichas = FichaTecnica::all();
        return view('perfume.form', compact('fichas'));
    }

    public function validateForm(Request $request, $id = null)
    {
        $request->validate([
            'nome' => 'required',
            'marca' => 'required',
            'preco' => 'required',
            'familia_olfativa' => 'required',
            'volume' => 'required',
            'ficha_tecnica_id' => 'required',
        ], [
            'nome.required' => 'O :attribute é obrigatório.',
            'marca.required' => 'A :attribute é obrigatória.',
            'preco.required' => 'O :attribute é obrigatório.',
            'familia_olfativa.required' => 'A :attribute é obrigatória.',
            'volume.required' => 'O :attribute é obrigatório.',
            'ficha_tecnica_id.required' => 'A ficha técnica é obrigatória.',
        ]);
    }

    public function store(Request $request)
    {
        $this->validateForm($request);

        Perfume::create($request->all());

        return redirect('perfume')->with("success", 'Registro Salvo com sucesso!');
    }

    public function edit($id)
    {
        $data = Perfume::with('fichaTecnica')->findOrFail($id);
        $fichas = FichaTecnica::all();
        return view('perfume.form', compact('data', 'fichas'));
    }

    public function update(Request $request, $id)
    {
        $this->validateForm($request, $id);

        Perfume::findOrFail($id)->update($request->all());

        return redirect('perfume')->with("success", 'Registro Atualizado com sucesso!');
    }

    public function destroy($id)
    {
        Perfume::destroy($id);

        return redirect('perfume')->with("success", 'Registro removido com sucesso!');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Perfume::with('fichaTecnica')->where(
                $request->tipo,
                'like',
                "%$request->valor%"
            )->get();
        } else {
            $dados = Perfume::with('fichaTecnica')->get();
        }

        return view('perfume.list', compact('dados'));
    }

    public function show($id)
    {
        $item = Perfume::with(['fichaTecnica', 'avaliacoes.usuario'])->findOrFail($id);
        return view('perfume.show', compact('item'));
    }
}