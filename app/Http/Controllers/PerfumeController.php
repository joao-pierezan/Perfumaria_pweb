<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perfume;
use App\Models\Notas;
use Illuminate\Support\Facades\Storage;

class PerfumeController extends Controller
{
    public function index()
    {
        $dados = Perfume::all();
        return view('perfume.list', compact('dados'));
    }

    public function create()
    {
        $notas = Notas::orderBy('nome')->get();
        return view('perfume.form', compact('notas'));
    }

    public function validateForm(Request $request, $id = null)
    {
        $request->validate([
            'nome' => 'required',
            'marca' => 'required',
            'preco' => 'required',
            'familia_olfativa' => 'required',
            'volume' => 'required',
            'imagem' => 'nullable|image|mimes:png,jpg,jpeg,webp',
        ], [
            'nome.required' => 'O :attribute é obrigatório.',
            'marca.required' => 'A :attribute é obrigatória.',
            'preco.required' => 'O :attribute é obrigatório.',
            'familia_olfativa.required' => 'A :attribute é obrigatória.',
            'volume.required' => 'O :attribute é obrigatório.',
            'imagem.image' => 'O arquivo enviado deve ser uma imagem.',
            'imagem.mimes' => 'A imagem deve ser das extensões: PNG, JPG, JPEG, WEBP.',
        ]);
    }

    public function store(Request $request)
    {
        $this->validateForm($request);

        $data = $request->all();
        $imagem = $request->file('imagem');

        if ($imagem) {
            $nome_imagem = date('YmdiHs') . "." . $imagem->getClientOriginalExtension();
            $diretorio = "imagem/perfume/";
            $imagem->storeAs($diretorio, $nome_imagem, 'public');
            $data['imagem'] = $diretorio . $nome_imagem;
        }

        $perfume = Perfume::create($data);

        // Vincula as notas selecionadas nas três camadas (N:N)
        if (!empty($request->notas_topo)) {
            foreach ($request->notas_topo as $notaId) {
                $perfume->notas()->attach($notaId, ['tipo' => 'topo']);
            }
        }
        if (!empty($request->notas_coracao)) {
            foreach ($request->notas_coracao as $notaId) {
                $perfume->notas()->attach($notaId, ['tipo' => 'coracao']);
            }
        }
        if (!empty($request->notas_fundo)) {
            foreach ($request->notas_fundo as $notaId) {
                $perfume->notas()->attach($notaId, ['tipo' => 'fundo']);
            }
        }

        return redirect('perfume')->with("success", 'Registro Salvo com sucesso!');
    }

    public function edit($id)
    {
        $data = Perfume::findOrFail($id);
        $notas = Notas::orderBy('nome')->get();

        $notasTopoIds = $data->notasTopo()->pluck('notas.id')->toArray();
        $notasCoracaoIds = $data->notasCoracao()->pluck('notas.id')->toArray();
        $notasFundoIds = $data->notasFundo()->pluck('notas.id')->toArray();

        return view('perfume.form', compact('data', 'notas', 'notasTopoIds', 'notasCoracaoIds', 'notasFundoIds'));
    }

    public function update(Request $request, $id)
    {
        $this->validateForm($request, $id);

        $perfume = Perfume::findOrFail($id);
        $data = $request->all();
        $imagem = $request->file('imagem');

        if ($imagem) {
            if ($perfume->imagem && Storage::disk('public')->exists($perfume->imagem)) {
                Storage::disk('public')->delete($perfume->imagem);
            }
            $nome_imagem = date('YmdiHs') . "." . $imagem->getClientOriginalExtension();
            $diretorio = "imagem/perfume/";
            $imagem->storeAs($diretorio, $nome_imagem, 'public');
            $data['imagem'] = $diretorio . $nome_imagem;
        }

        $perfume->update($data);

        // Atualiza as notas da pirâmide olfativa
        $perfume->notas()->detach();

        if (!empty($request->notas_topo)) {
            foreach ($request->notas_topo as $notaId) {
                $perfume->notas()->attach($notaId, ['tipo' => 'topo']);
            }
        }
        if (!empty($request->notas_coracao)) {
            foreach ($request->notas_coracao as $notaId) {
                $perfume->notas()->attach($notaId, ['tipo' => 'coracao']);
            }
        }
        if (!empty($request->notas_fundo)) {
            foreach ($request->notas_fundo as $notaId) {
                $perfume->notas()->attach($notaId, ['tipo' => 'fundo']);
            }
        }

        return redirect('perfume')->with("success", 'Registro Atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $perfume = Perfume::findOrFail($id);

        if ($perfume->imagem && Storage::disk('public')->exists($perfume->imagem)) {
            Storage::disk('public')->delete($perfume->imagem);
        }

        $perfume->delete();

        return redirect('perfume')->with("success", 'Registro removido com sucesso!');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $campo = in_array($request->tipo, ['nome', 'marca', 'familia_olfativa', 'preco']) ? $request->tipo : 'nome';
            $dados = Perfume::where(
                $campo,
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
        $item = Perfume::with([
            'avaliacoes.usuario',
            'notasTopo',
            'notasCoracao',
            'notasFundo'
        ])->findOrFail($id);

        return view('perfume.show', compact('item'));
    }
}