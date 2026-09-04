<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function index()
    {
        $dados = Usuario::all();

        return view('usuario.list')->with(['dados' => $dados]);
    }

    public function create()
    {
        return view('usuario.form');
    }

    public function validateForm(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'cpf' => 'required',
            'email' => 'required',
            'telefone' => 'required',
        ], [
            'nome.required' => "O :attribute é obrigatório",
            'cpf.required' => "O :attribute é obrigatório",
            'email.required' => "O :attribute é obrigatório",
            'telefone.required' => "O :attribute é obrigatório",
        ]);
    }

    public function store(Request $request)
    {
        $this->validateForm($request);

        Usuario::create($request->all());

        return redirect('usuario')->with("success", 'Registro Salvo com sucesso!');
    }

    public function edit($id)
    {
        $data = Usuario::findOrFail($id);

        return view('usuario.form', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validateForm($request);

        Usuario::findOrFail($id)->update($request->all());

        return redirect('usuario')->with("success", 'Registro Atualizado com sucesso!');
    }

    public function destroy($id)
    {
        Usuario::destroy($id);

        return redirect('usuario')->with("success", 'Registro removido com sucesso!');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Usuario::where(
                $request->tipo,
                'like',
                "%$request->valor%"
            )->get();
        } else {
            $dados = Usuario::all();
        }

        return view('usuario.list', compact('dados'));
    }
}