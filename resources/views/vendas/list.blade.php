@extends('main')
@section('titulo', 'Lista de Vendas')
@section('conteudo')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Lista de Vendas</h2>
            <a href="{{ route('vendas.create') }}" class="btn btn-success">Nova Venda</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Formulário de Pesquisa (conecta com a função search do VendasController) -->
        <form action="{{ route('vendas.search') }}" method="GET" class="row g-2 mb-4">
            <div class="col-md-9">
                <input type="text" name="valor" value="{{ request('valor') }}" placeholder="Pesquisar pelo nome do perfume..." class="form-control">
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">Buscar</button>
                @if(request('valor'))
                    <a href="{{ route('vendas.index') }}" class="btn btn-outline-secondary" title="Limpar pesquisa">Limpar</a>
                @endif
            </div>
        </form>

        <!-- Tabela de Listagem -->
        <div class="table-responsive shadow-sm border rounded p-3 bg-white">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Perfume</th>
                        <th>Usuário / Comprador</th>
                        <th>Valor Total</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($a ?? [] as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ trim(($item->perfume->marca ?? '') . ' ' . ($item->perfume->nome ?? $item->perfume->name ?? '')) }}</td>
                            <td>{{ $item->usuario->nome ?? $item->usuario->name ?? 'N/A' }}</td>
                            <td>R$ {{ number_format($item->valor_total ?? 0, 2, ',', '.') }}</td>
                            <td class="text-end">
                                <a href="{{ route('vendas.edit', $item->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('vendas.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Tens a certeza que pretendes eliminar este registo?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Nenhuma venda encontrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop