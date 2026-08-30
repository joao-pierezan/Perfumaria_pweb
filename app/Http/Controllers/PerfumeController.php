<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perfume;

class PerfumeController extends Controller
{
    public function index()
    {
        $dados = Perfume::all();

        return view('perfume.list')->with(['dados' => $dados]);
    }

    public function create()
    {
        return view('perfume.form');
    }

    public function validateForm(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'marca' => 'required',
            'preco' => 'required',
            'familia_olfativa' => 'required',
            'volume' => 'required',
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

        // dd($data);
        //return view('Perfume.form')->with(['data' => $data]);
        return view('perfume.form', compact('data'));
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
}