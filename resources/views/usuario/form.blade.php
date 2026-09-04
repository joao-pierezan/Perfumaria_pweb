@extends('main')
@section('titulo', 'Formulário de Usuarios')
@section('conteudo')
    <div class="row">
        @php
            if (!empty($data->id)) {
                $action = route('usuario.update', $data->id);
            } else {
                $action = route('usuario.store');
            }
        @endphp

        <h4>Formulário Usuarios</h4>
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
                <label for="cpf">CPF</label>
                <input type="cpf" name="cpf" class="form-control" value="{{ old('cpf', $data->cpf ?? '') }}">
            </div>
            <div class="col-6">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control"
                    value="{{ old('email', $data->email ?? '') }}">
            </div>
            <div class="col-6">
                <label for="telefone">Telefone</label>
                <input type="telefone" name="telefone" class="form-control"
                    value="{{ old('telefone', $data->telefone ?? '') }}">
            </div>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="{{ url('usuario') }}" class="btn btn-primary"> Voltar</a>
            </div>
        </form>
    </div>
@stop
