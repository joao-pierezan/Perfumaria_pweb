@extends('main')
@section('titulo', 'Formulário de Avaliações')
@section('conteudo')
    <div class="row">
        @php
            if (!empty($data->id)) {
                $action = route('avaliacoes.update', $data->id);
            } else {
                $action = route('avaliacoes.store');
            }
        @endphp

        <h4>Formulário Avaliação</h4>
        <form action="{{ $action }}" method="post">
            @csrf
            @if (!empty($data->id))
                @method('PUT')
            @endif

            <input type="hidden" name="id" value="{{ old('id', $data->id ?? '') }}">
            
            <div class="col-6 mb-3">
                <label for="autor">Autor / Usuário</label>
                <select name="autor" class="form-select" required>
                    <option value="">Selecione um usuário...</option>
                    @foreach ($usuarios ?? [] as $item)
                        @php
                            $userValue = $item->id;
                            $isSelected = (
                                old('autor', $data->usuario_id ?? $data->autor ?? '') == $userValue
                            );
                        @endphp
                        <option value="{{ $userValue }}" {{ $isSelected ? 'selected' : '' }}>
                            {{ $item->nome ?? $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-6 mb-3">
                <label for="perfume">Perfume</label>
                <select name="perfume" class="form-select" required>
                    <option value="">Selecione um perfume...</option>
                    @foreach ($perfumes ?? [] as $item)
                        @php
                            $nomeCompleto = trim(($item->marca ?? '') . ' ' . ($item->nome ?? $item->name));
                            // Se a sua tabela salva o ID do perfume, use $item->id. Se salva o texto, use $nomeCompleto.
                            $perfumeValue = $item->id; 
                            $isSelectedPerfume = (
                                old('perfume', $data->perfume_id ?? $data->perfume ?? '') == $perfumeValue || 
                                old('perfume', $data->perfume_id ?? $data->perfume ?? '') == $nomeCompleto
                            );
                        @endphp
                        <option value="{{ $perfumeValue }}" {{ $isSelectedPerfume ? 'selected' : '' }}>
                            {{ $nomeCompleto }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-6 mb-3">
                <label for="nota">Nota de 0 a 10</label>
                <input type="number" step="0.01" min="0" max="10" name="nota" class="form-control" value="{{ old('nota', $data->nota ?? '') }}" required>
            </div>

            <div class="col-12 mb-3">
                <label for="texto">Resenha</label>
                <textarea name="texto" class="form-control" rows="4" required>{{ old('texto', $data->texto ?? '') }}</textarea>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="{{ url('perfume/'.$data->perfume) }}" class="btn btn-primary"> Voltar</a>
            </div>
        </form>
    </div>
@stop