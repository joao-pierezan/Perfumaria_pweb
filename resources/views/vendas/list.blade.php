@extends('main')
@section('titulo', 'Catálogo de Vendas')

@section('conteudo')
<div class="container mt-5">
    <h1>Lista de Vendas</h1>

    <!-- Formulário de Pesquisa -->
    <form action="{{ route('vendas.search') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="valor" class="form-control" placeholder="Pesquisar por nome do perfume..." value="{{ request('valor') }}">
            <button type="submit" class="btn btn-primary">Buscar</button>
            <a href="{{ route('vendas.index') }}" class="btn btn-secondary">Limpar</a>
        </div>
    </form>

    <a href="{{ route('vendas.create') }}" class="btn btn-success mb-3">Nova Venda</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Perfume</th>
                <th>Comprador / Usuário</th>
                <th>Valor Total</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($a as $venda)
            <tr>
                <td>{{ $venda->id }}</td>
                <td>{{ $venda->perfume->nome}}</td>
                <td>{{ $venda->usuario->nome}}</td>
                <td>R$ {{ number_format($venda->valor_total, 2, ',', '.') }}</td>
                <td>
                    <a href="{{ route('vendas.edit', $venda->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('vendas.destroy', $venda->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tens a certeza que queres apagar?')">Apagar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection