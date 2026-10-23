<?php

namespace App\Http\Controllers;

use App\Models\Notas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NotasController extends Controller
{
    public function index()
    {
         $dados= Notas::all();

        return view('notas.list', compact('dados'));
    }

    public function create()
    {
        return view('notas.form');
    }

    public function validateForm(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'descricao' => 'nullable',
            'imagem' => 'nullable|image|mimes:png,jpg,jpeg,webp',
        ], [
            'nome.required' => "O :attribute é obrigatório",
            'imagem.image' => "O :attribute deve ser uma imagem válida",
            'imagem.mimes' => "O :attribute deve ter uma das extensões: PNG, JPG, JPEG, WEBP",
        ]);
    }

    public function store(Request $request)
    {
        $this->validateForm($request);

        $data = $request->all();
        $imagem = $request->file('imagem');

        if ($imagem) {
            $nome_imagem = date('YmdiHs') . "." . $imagem->getClientOriginalExtension();
            $diretorio = "notas"; 
            $imagem->storeAs($diretorio, $nome_imagem, 'public');
            $data['imagem'] = $diretorio . '/' . $nome_imagem;
        }

        Notas::create($data);

        return redirect('notas')->with("success", 'Registro Salvo com sucesso!');
    }

    public function edit($id)
    {
        $data = Notas::findOrFail($id);

        return view('notas.form', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validateForm($request);

        $nota = Notas::findOrFail($id);
        $data = $request->all();
        $imagem = $request->file('imagem');

        if ($imagem) {
            if ($nota->imagem && Storage::disk('public')->exists($nota->imagem)) {
                Storage::disk('public')->delete($nota->imagem);
            }

            $nome_imagem = date('YmdiHs') . "." . $imagem->getClientOriginalExtension();
            $diretorio = "notas";
            $imagem->storeAs($diretorio, $nome_imagem, 'public');
            $data['imagem'] = $diretorio . '/' . $nome_imagem;
        }

        $nota->update($data);

        return redirect('notas')->with("success", 'Registro Atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $nota = Notas::findOrFail($id);

        if ($nota->imagem && Storage::disk('public')->exists($nota->imagem)) {
            Storage::disk('public')->delete($nota->imagem);
        }

        $nota->delete();

        return redirect('notas')->with("success", 'Registro removido com sucesso!');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $campo = in_array($request->tipo, ['nome', 'descricao']) ? $request->tipo : 'nome';
            $dados = Notas::where(
                $campo,
                'like',
                "%$request->valor%"
            )->get();
        } else {
            $dados = Notas::all();
        }

        return view('notas.list', compact('dados'));
    }
}