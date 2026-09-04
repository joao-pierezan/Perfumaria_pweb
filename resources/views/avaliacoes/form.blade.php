@extends('main')
@section('titulo', 'Formulário de Perfumes')
@section('conteudo')
    <div class="row">
        @php
            if (!empty($data->id)) {
                $action = route('avaliacoes.update', $data->id);
            } else {
                $action = route('avaliacoes.store');
            }
        @endphp

        <h4>Formulário Perfume</h4>
        <form action="{{ $action }}" method="post">
            @csrf
            @if (!empty($data->id))
                @method('PUT')
            @endif

            <input type="hidden" name="id" value="{{ old('id', $data->id ?? '') }}">
            
            <div class="col-6">
                <label for="autor">Autor / Usuário</label>
                <select name="autor" class="form-select">
                    <option value="">Selecione um usuário...</option>
                    

                    @foreach ($usuarios as $item)
                        <option value="{{ $item->id }}" 
                            {{ old('autor', $data->autor ?? '') == $item->id ? 'selected' : '' }}>
                            {{ $item->nome ?? $item->name }}
                        </option>
                    @endforeach

                </select>
            </div>

                </select>
            </div>
            <div class="col-6">
                <label for="perfume">Perfume</label>
                <select name="perfume" class="form-select">
                    <option value="">Selecione um perfume...</option>
                    @foreach ($perfumes as $item)
                        @php
                            // Monta o nome completo: "Marca Nome"
                            $nomeCompleto = trim(($item->marca ?? '') . ' ' . ($item->nome ?? $item->name));
                        @endphp
                        <option value="{{ $nomeCompleto }}" 
                            {{ old('perfume', $data->perfume ?? '') == $nomeCompleto ? 'selected' : '' }}>
                            {{ $nomeCompleto }}
                        </option>
                    @endforeach
                </select>
            </div>
                <div class="col-6">
                    <label for="nota">Nota de 0 a 10</label>
                    <input type="number" step="0.01" min="0" max="10" name="nota" class="form-control" value="{{ old('nota', $data->nota ?? '') }}">
                </div>

                <div class="col-12">
                    <label for="texto">Resenha</label>
                    <textarea name="texto" class="form-control" rows="4">{{ old('texto', $data->texto ?? '') }}</textarea>
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="{{ url('avaliacoes') }}" class="btn btn-primary"> Voltar</a>
            </div>
        </form>
    </div>
@stop