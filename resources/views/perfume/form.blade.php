@extends('main')
@section('titulo', 'Formulário de Perfumes')
@section('conteudo')
    <div class="row">
        @php
            if (!empty($data->id)) {
                $action = route('perfume.update', $data->id);
            } else {
                $action = route('perfume.store');
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
                <label for="nome">Nome</label>
                <input type="text" name="nome" class="form-control" value="{{ old('nome', $data->nome ?? '') }}">
            </div>
            <div class="col-6">
                <label for="cpf">Marca</label>
                <input type="marca" name="marca" class="form-control" value="{{ old('marca', $data->marca ?? '') }}">
            </div>
            <div class="col-6">
                <label for="preco">Preço</label>
                <input type="text" name="preco" class="form-control"
                    value="{{ old('telefone', $data->preco ?? '') }}">
            </div>
            <div class="col-6">
                <label for="familia_olfativa">Familia Olfativa</label>
                <input type="familia_olfativa" name="familia_olfativa" class="form-control" value="{{ old('familia_olfativa', $data->familia_olfativa ?? '') }}">
            </div>
            <div class="col-6">
                <label for="volume">Volume em ml</label>
                <input type="text" name="volume" class="form-control"
                    value="{{ old('volume', $data->volume ?? '') }}">
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="{{ url('perfume') }}" class="btn btn-primary"> Voltar</a>
            </div>
        </form>
    </div>
@stop
