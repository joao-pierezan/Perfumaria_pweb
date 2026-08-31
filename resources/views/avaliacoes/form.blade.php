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
                <label for="perfume">Perfume</label>
                <input type="text" name="perfume" class="form-control" value="{{ old('perfume', $data->perfume ?? '') }}">
            </div>
            <div class="col-6">
                <label for="nota">Nota de 0 a 10</label>
                <input type="decimal" name="nota" class="form-control" value="{{ old('nota', $data->nota ?? '') }}">
            </div>
            <div class="col-6">
                <label for="texto">Resenha</label>
                <textarea type="text" name="texto" class="form-control" value="{{ old('texto', $data->texto ?? '') }}"></textarea>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="{{ url('avaliacoes') }}" class="btn btn-primary"> Voltar</a>
            </div>
        </form>
    </div>
@stop
