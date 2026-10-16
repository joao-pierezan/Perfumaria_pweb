@extends('main')
@section('titulo', 'Cadastro de Vendas')

@section('conteudo')
    <h1>{{ isset($a->id) ? 'Editar Venda' : 'Nova Venda' }}</h1>

    <form action="{{ isset($a->id) ? route('vendas.update', $a->id) : route('vendas.store') }}" method="POST">
        @csrf
        @if(isset($a->id))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="perfume_id" class="form-label">Perfume</label>
            <select name="perfume_id" id="perfume_id" class="form-control" required>
                <option value="">Selecione um perfume</option>
                @foreach($b as $perfume)
                    <option value="{{ $perfume->id }}" {{ (isset($a->perfume_id) && $a->perfume_id == $perfume->id) ? 'selected' : '' }}>
                        {{ $perfume->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="usuario_id" class="form-label">Usuário</label>
            <select name="usuario_id" id="usuario_id" class="form-control" required>
                <option value="">Selecione um usuário</option>
                @foreach($c as $usuario)
                    <option value="{{ $usuario->id }}" {{ (isset($a->usuario_id) && $a->usuario_id == $usuario->id) ? 'selected' : '' }}>
                        {{ $usuario->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-6 mb-3">
            <label for="valor_total">Valor Total</label>
            <input type="number" name="valor_total" class="form-control" value="{{ old('valor_total', $a->valor_total ) }}">
        </div>

        <button type="submit" class="btn btn-success">{{ isset($a->id) ? 'Atualizar' : 'Salvar' }}</button>
        <a href="{{ route('vendas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection