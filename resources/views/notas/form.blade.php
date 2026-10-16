@extends('main')
@section('titulo', 'Formulário de Notas Olfativas')
@section('conteudo')
    <div class="row">
        @php
            if (!empty($data->id)) {
                $action = route('notas.update', $data->id);
            } else {
                $action = route('notas.store');
            }
        @endphp

        <h4 class="mb-3">{{ !empty($data->id) ? 'Editar Nota Olfativa' : 'Cadastrar Nota Olfativa' }}</h4>
        
        <form action="{{ $action }}" method="post" enctype="multipart/form-data">
            @csrf
            @if (!empty($data->id))
                @method('PUT')
            @endif

            <input type="hidden" name="id" value="{{ old('id', $data->id ?? '') }}">
            
            <div class="row">
                <div class="col-12 mb-3">
                    <label for="nome" class="form-label fw-bold">Nome da Nota</label>
                    <input type="text" name="nome" class="form-control" value="{{ old('nome', $data->nome ?? '') }}" placeholder="Ex: Lavanda, Baunilha, Bergamota..." required>
                </div>

                <div class="col-12 mb-3">
                    <label for="imagem" class="form-label fw-bold">Imagem da Nota</label>
                    @php
                        $srcImagem = asset('img/aromatica.jpg');
                        if (!empty($data->imagem)) {
                            if (file_exists(public_path($data->imagem))) {
                                $srcImagem = asset($data->imagem);
                            } elseif (file_exists(public_path('imagensNotas/' . $data->imagem))) {
                                $srcImagem = asset('imagensNotas/' . $data->imagem);
                            } else {
                                $srcImagem = asset('storage/' . $data->imagem);
                            }
                        }
                    @endphp
                                        <div class="d-flex align-items-center gap-3">
                        <img src="{{ $srcImagem }}" class="rounded shadow-sm border" width="90" height="90" style="object-fit: cover;" alt="Prévia da Imagem" />
                        <div class="flex-grow-1">
                            <input type="file" name="imagem" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <label for="descricao" class="form-label fw-bold">Descrição Olfativa</label>
                    <textarea name="descricao" class="form-control" rows="4" placeholder="Descreva as características aromáticas desta nota (ex: Fresca, adocicada, cítrica, etc.)">{{ old('descricao', $data->descricao ?? '') }}</textarea>
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="{{ url('notas') }}" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    </div>
@stop

