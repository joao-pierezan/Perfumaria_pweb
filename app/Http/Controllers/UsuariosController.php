<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;
use App\Models\CategoriaUsuarios;

class UsuariosController extends Controller
{
    public function index()
    {
        $dados = Usuarios::All();

        return view('usuarios.list')->with(['dados' => $dados]);
    }

    function create()
    {
        $categorias = CategoriaUsuarios::orderBy('nome')->get();

        return view('usuarios.form', compact('categorias'));
    }


    function validateForm(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'cpf' => 'required',
            'categoria_id' => 'required',
        ], [
            'nome.required' => "O :attribute é obrigatorio",
            'cpf.required' => "O :attribute é obrigatorio",
            'categoria_id.required' => "O :attribute é obrigatorio"
        ]);
    }

    function store(Request $request)
    {
        //dd($request->all());
        $this->validateForm($request);

        Usuarios::create($request->all());

        return redirect('usuarios')->with("success", 'Registro Salvo com sucesso!');
    }

    function edit($id)
    {
        $data = Usuarios::find($id);
        $categorias = CategoriaUsuarios::orderBy('nome')->get();

        // dd($data);
        //return view('usuarios.form')->with(['data' => $data]);
        return view('usuarios.form', [
            compact('data'),
            compact('categorias'),
        ]);
    }


    function update(Request $request, $id)
    {
        //dd($request->all());
        $this->validateForm($request);

        Usuarios::find($id)->update($request->all());

        return redirect('usuarios')->with("success", 'Registro Atualizado com sucesso!');
    }

    function destroy($id)
    {
        Usuarios::destroy($id);

        return redirect('usuarios')->with("success", 'Registro removido com sucesso!');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Usuarios::where(
                $request->tipo,
                'like',
                "%$request->valor%"
            )->get();
        } else {
            $dados = Usuarios::All();
        }

        return view('usuarios.list', compact('dados'));
    }
}

