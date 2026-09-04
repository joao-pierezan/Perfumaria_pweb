@extends('main')
@section('titulo', 'Catálogo de Perfumes')
@section('conteudo')

    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h3>Catálogo de Perfumes</h3>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ url('perfume/create') }}" class="btn btn-success">+ Novo Perfume</a>
        </div>
    </div>

    <form action="{{ route('perfume.search') }}" method="post" class="mb-4">
        @csrf
        <div class="row g-2">
            <div class="col-md-3">
                <select name="tipo" class="form-select">
                    <option value="nome">Nome</option>
                    <option value="marca">Marca</option>
                    <option value="preco">Preço</option>
                </select>
            </div>
            <div class="col-md-7">
                <input type="text" name="valor" placeholder="Pesquisar por perfume, marca..." class="form-control">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Buscar</button>
            </div>
        </div>
    </form>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @foreach ($dados as $item)
            <div class="col">
                <div class="card h-100 border shadow-sm">
                    <div class="bg-light text-center py-4 border-bottom">
                        <span class="fs-1">Imagem 👍</span>
                    </div>

                    <!-- Detalhes do Produto -->
                    <div class="card-body d-flex flex-column">
                        <small class="text-muted text-uppercase fw-bold">{{ $item->marca }}</small>
                        
                        <!-- Nome transformado em link clicável para os detalhes -->
                        <h5 class="card-title my-1">
                            <a href="{{ route('perfume.show', $item->id) }}" class="text-decoration-none text-dark">
                                {{ $item->nome }}
                            </a>
                        </h5>
                        
                        <div class="mb-2">
                            <span class="badge bg-secondary">{{ $item->familia_olfativa }}</span>
                            <small class="text-muted ms-1">{{ $item->volume }}ml</small>
                        </div>

                        <!-- Exibindo dados da Ficha Técnica (Relacionamento 1:1 em vez do ID) -->
                        <div class="bg-light p-2 rounded mb-3 border" style="font-size: 0.85rem;">
                            <span class="d-block text-truncate"><strong>Topo:</strong> {{ $item->fichaTecnica->notas_topo ?? 'N/A' }}</span>
                            <span class="d-block text-truncate"><strong>Coração:</strong> {{ $item->fichaTecnica->notas_coracao ?? 'N/A' }}</span>
                        </div>

                        <div class="mt-auto pt-2">
                            <span class="fs-6 text-muted">Preço:</span>
                            <h4 class="text-success fw-bold mb-0">R$ {{ number_format((float)$item->preco, 2, ',', '.') }}</h4>
                        </div>
                    </div>

                    <!-- Ações de Gerenciamento -->
                    <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between gap-2 pb-3">
                        <a class="btn btn-sm btn-outline-warning w-50" title="Editar" href="{{ route('perfume.edit', $item->id) }}">Editar</a>
                        
                        <form action="{{ route('perfume.destroy', $item->id) }}" method="post" class="w-50 m-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger w-100" title="Excluir"
                                onclick="return confirm('Deseja realmente excluir este perfume?')">Deletar</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Mensagem de lista vazia -->
    @if($dados->isEmpty())
        <div class="alert alert-info mt-4">
            Nenhum perfume encontrado no catálogo.
        </div>
    @endif

@stop