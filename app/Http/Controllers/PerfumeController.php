<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perfume;
use App\Models\FichaTecnica; // <-- Adicione esta linha no topo do controller

class PerfumeController extends Controller
{
    public function index()
    {
       $dados = Perfume::with('fichaTecnica')->get(); // ou Perfume::with('fichaTecnica')->get();
       return view('perfume.list', compact('dados'));
    }

    public function create()
    {
        $fichas = FichaTecnica::all();
        return view('perfume.form', compact('fichas'));
    }

    public function validateForm(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'marca' => 'required',
            'preco' => 'required',
            'familia_olfativa' => 'required',
            'volume' => 'required',
            'ficha_tecnica_id' => 'required|unique:perfumes,ficha_tecnica_id',
        ], [
            'nome.required' => "O :attribute é obrigatorio",
            'marca.required' => "O :attribute é obrigatorio",
            'preco.required' => "O :attribute é obrigatorio",
            'familia_olfativa.required' => "O :attribute é obrigatorio",
            'volume.required' => "O :attribute é obrigatorio",

        ]);
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $this->validateForm($request);

        Perfume::create($request->all());

        return redirect('perfume')->with("success", 'Registro Salvo com sucesso!');
    }

    public function edit($id)
    {
        $data = Perfume::findOrFail($id);
        $fichas = FichaTecnica::all();
        return view('perfume.form', compact('data', 'fichas'));
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $this->validateForm($request);

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
            $dados = Perfume::where(
                $request->tipo,
                'like',
                "%$request->valor%"
            )->get();
        } else {
            $dados = Perfume::all();
        }

        return view('perfume.list', compact('dados'));
    }

    public function show($id)
    {
    // Carrega o perfume junto com a ficha técnica
    $item = Perfume::with('fichaTecnica')->findOrFail($id);

    return view('perfume.show', compact('item'));
    }
}