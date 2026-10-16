@extends('main')
@section('titulo', 'Comprar o perfume '.($item->nome))
@section('conteudo')

@php
    $imagemPerfume = asset('images/sem-foto.avif'); // Imagem padrão (fallback)

    if (!empty($item->imagem)) {
        // 1. Caminhos para verificar se está no Storage
        $caminhoStorageDisk = storage_path('app/public/' . $item->imagem);
        $caminhoStoragePublic = public_path('storage/' . $item->imagem);

        // 2. Caminho para verificar se está na pasta public/Imagens
        $caminhoPublicImagens = public_path('Imagens/' . $item->imagem);

        if (file_exists($caminhoStorageDisk) || file_exists($caminhoStoragePublic)) {
            // Se estiver no storage, usa a rota do storage
            $imagemPerfume = asset('storage/' . $item->imagem);
        } elseif (file_exists($caminhoPublicImagens)) {
            // Se estiver na pasta Imagens, usa a rota direta
            $imagemPerfume = asset('Imagens/' . $item->imagem);
        }
    }
@endphp

<div class="container py-3">
    <!-- Navegação de Retorno -->
    <div class="mb-3">
        <a href="{{ url('perfume') }}" class="btn btn-outline-secondary btn-sm">
            &larr; Voltar ao Catálogo
        </a>
    </div>

    <!-- Seção Principal: Imagem e Informações do Produto -->
    <div class="row g-4 mb-5">
        <!-- Coluna da Imagem -->
        <div class="col-md-5">
            <div class="card border-0 shadow-sm bg-light text-center p-4 d-flex align-items-center justify-content-center" style="min-height: 380px;">
                <img src="{{ $imagemPerfume }}" 
                     alt="{{ $item->nome }}" 
                     class="img-fluid rounded" 
                     style="max-height: 350px; object-fit: contain;">
            </div>
        </div>

        <!-- Coluna das Informações -->
        <div class="col-md-7 d-flex flex-column justify-content-between">
            <div>
                <span class="badge bg-dark text-uppercase mb-2 px-3 py-2 fs-6">{{ $item->marca }}</span>
                <h1 class="fw-bold mb-2">{{ $item->nome }}</h1>
                
                <div class="mb-3">
                    <span class="badge bg-secondary me-2">{{ $item->familia_olfativa }}</span>
                    <span class="badge bg-light text-dark border">{{ $item->volume }}</span>
                </div>

                <div class="my-4 p-3 bg-light rounded border">
                    <span class="text-muted d-block mb-1">Preço:</span>
                    <h2 class="text-success fw-bold mb-0">R$ {{ number_format((float)$item->preco, 2, ',', '.') }}</h2>
                </div>
            </div>

            <!-- Ações -->
            <div class="pt-3 border-top d-flex flex-wrap gap-2 align-items-center">
                <a href="{{ url('vendas/create?perfume_id=' . $item->id) }}" type="button" class="btn btn-primary btn-lg px-4 fw-bold">
                    Comprar Agora
                </a>
                <a href="{{ route('perfume.edit', $item->id) }}" class="btn btn-outline-warning">
                    Editar Perfume
                </a>
                <form action="{{ route('perfume.destroy', $item->id) }}" method="post" class="d-inline m-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Deseja realmente excluir este perfume?')">
                        Deletar Perfume
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border mb-5">
        <div class="card-header bg-light py-3 text-center">
            <h4 class="mb-0 fw-bold">Pirâmide Olfativa</h4>
        </div>
        <div class="card-body p-4 bg-white">
            
            <div class="mb-4">
                <div class="d-flex align-items-center justify-content-center my-3">
                    <div class="border-top flex-grow-1"></div>
                    <span class="px-3 text-secondary text-uppercase fw-bold" style="letter-spacing: 2px; font-size: 0.85rem;">
                        NOTAS DE TOPO
                    </span>
                    <div class="border-top flex-grow-1"></div>
                </div>

                <div class="d-flex flex-wrap justify-content-center gap-4 py-2">
                    @forelse($item->notasTopo as $nota)
                        @php
                            $srcNota = asset('img/aromatica.jpg');
                            if (!empty($nota->imagem)) {
                                if (file_exists(public_path($nota->imagem))) {
                                    $srcNota = asset($nota->imagem);
                                } elseif (file_exists(public_path('imagensNotas/' . $nota->imagem))) {
                                    $srcNota = asset('imagensNotas/' . $nota->imagem);
                                } elseif (file_exists(public_path('storage/' . $nota->imagem))) {
                                    $srcNota = asset('storage/' . $nota->imagem);
                                } else {
                                    $srcNota = asset($nota->imagem);
                                }
                            }
                        @endphp
                        <div class="text-center" style="width: 90px;">
                            <div class="bg-white border rounded-3 p-1 shadow-sm d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 72px; height: 72px;">
                                <img src="{{ $srcNota }}" alt="{{ $nota->nome }}" class="w-100 h-100 rounded" style="object-fit: cover;">
                            </div>
                            <span class="d-block text-secondary fw-semibold" style="font-size: 0.82rem;">{{ $nota->nome }}</span>
                        </div>
                    @empty
                        <p class="text-muted small fst-italic mb-0">Nenhuma nota de topo informada.</p>
                    @endforelse
                </div>
            </div>
            <div class="mb-4">
                <div class="d-flex align-items-center justify-content-center my-3">
                    <div class="border-top flex-grow-1"></div>
                    <span class="px-3 text-secondary text-uppercase fw-bold" style="letter-spacing: 2px; font-size: 0.85rem;">
                        NOTAS DE CORAÇÃO
                    </span>
                    <div class="border-top flex-grow-1"></div>
                </div>

                <div class="d-flex flex-wrap justify-content-center gap-4 py-2">
                    @forelse($item->notasCoracao as $nota)
                        @php
                            $srcNota = asset('img/aromatica.jpg');
                            if (!empty($nota->imagem)) {
                                if (file_exists(public_path($nota->imagem))) {
                                    $srcNota = asset($nota->imagem);
                                } elseif (file_exists(public_path('imagensNotas/' . $nota->imagem))) {
                                    $srcNota = asset('imagensNotas/' . $nota->imagem);
                                } elseif (file_exists(public_path('storage/' . $nota->imagem))) {
                                    $srcNota = asset('storage/' . $nota->imagem);
                                } else {
                                    $srcNota = asset($nota->imagem);
                                }
                            }
                        @endphp
                        <div class="text-center" style="width: 90px;">
                            <div class="bg-white border rounded-3 p-1 shadow-sm d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 72px; height: 72px;">
                                <img src="{{ $srcNota }}" alt="{{ $nota->nome }}" class="w-100 h-100 rounded" style="object-fit: cover;">
                            </div>
                            <span class="d-block text-secondary fw-semibold" style="font-size: 0.82rem;">{{ $nota->nome }}</span>
                        </div>
                    @empty
                        <p class="text-muted small fst-italic mb-0">Nenhuma nota de coração informada.</p>
                    @endforelse
                </div>
            </div>

            <div>
                <div class="d-flex align-items-center justify-content-center my-3">
                    <div class="border-top flex-grow-1"></div>
                    <span class="px-3 text-secondary text-uppercase fw-bold" style="letter-spacing: 2px; font-size: 0.85rem;">
                        NOTAS DE BASE
                    </span>
                    <div class="border-top flex-grow-1"></div>
                </div>

                <div class="d-flex flex-wrap justify-content-center gap-4 py-2">
                    @forelse($item->notasFundo as $nota)
                        @php
                            $srcNota = asset('img/aromatica.jpg');
                            if (!empty($nota->imagem)) {
                                if (file_exists(public_path($nota->imagem))) {
                                    $srcNota = asset($nota->imagem);
                                } elseif (file_exists(public_path('imagensNotas/' . $nota->imagem))) {
                                    $srcNota = asset('imagensNotas/' . $nota->imagem);
                                } elseif (file_exists(public_path('storage/' . $nota->imagem))) {
                                    $srcNota = asset('storage/' . $nota->imagem);
                                } else {
                                    $srcNota = asset($nota->imagem);
                                }
                            }
                        @endphp
                        <div class="text-center" style="width: 90px;">
                            <div class="bg-white border rounded-3 p-1 shadow-sm d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 72px; height: 72px;">
                                <img src="{{ $srcNota }}" alt="{{ $nota->nome }}" class="w-100 h-100 rounded" style="object-fit: cover;">
                            </div>
                            <span class="d-block text-secondary fw-semibold" style="font-size: 0.82rem;">{{ $nota->nome }}</span>
                        </div>
                    @empty
                        <p class="text-muted small fst-italic mb-0">Nenhuma nota de fundo informada.</p>
                    @endforelse
                </div>
            </div>

        </div>
            </div>
            <div class="card shadow-sm border mb-4">
                <div class="card-header bg-light py-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0 fw-bold">Avaliações do Perfume {{ $item->nome }}</h4>
                <a href="{{ url('avaliacoes/create?perfume_id=' . $item->id) }}" class="btn btn-outline-success btn-sm">
                    Criar Avaliação
                </a>
            </div>
            <form action="{{ url('perfume/' . $item->id) }}" method="GET" class="row g-2 align-items-end">
            <div class="col-md-3">
                <label for="tipo" class="form-label small fw-bold text-muted">Tipo</label>
                <select name="tipo" class="form-select">
                    <option value="autor" {{ request('tipo') === 'autor' ? 'selected' : '' }}>Autor</option>
                    <option value="nota" {{ request('tipo') === 'nota' ? 'selected' : '' }}>Nota</option>
                    <option value="texto" {{ request('tipo') === 'texto' ? 'selected' : '' }}>Resenha</option>
                </select>
            </div>
            
            <div class="col-md-6">
                <label for="valor" class="form-label small fw-bold text-muted">Valor</label>
                <input type="text" name="valor" value="{{ request('valor') }}" placeholder="Pesquisar..." class="form-control">
            </div>

            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">Buscar</button>
                @if(request('valor'))
                    <a href="{{ url('perfume/' . $item->id) }}" class="btn btn-outline-secondary" title="Limpar pesquisa">Limpar</a>
                @endif
            </div>
        </form>
        </div>
        <div class="card-body p-4">
            @forelse ($item->avaliacoes as $avaliacao)
                <div class="card mb-3 border bg-white">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $avaliacao->usuario?->nome}}</strong>
                        </div>
                        <span class="badge bg-warning text-dark fs-6">
                            Nota: {{ $avaliacao->nota }} / 10
                        </span>
                    </div>
                    <div class="card-body">
                        <p class="card-text fs-6" style="white-space: pre-line;">
                            {{ $avaliacao->texto }}
                        </p>
                    </div>
                    <div class="card-footer text-muted py-1 d-flex justify-content-between align-items-center" style="font-size: 0.85rem;">
                        <span>Data: {{ $avaliacao->created_at?->format('d/m/Y') ?? 'N/A' }}</span>
                        <div class="d-flex gap-2">
                            <a href="{{ route('avaliacoes.edit', $avaliacao->id) }}" class="btn btn-sm btn-link p-0 text-decoration-none">Editar</a>
                            <form action="{{ route('avaliacoes.destroy', $avaliacao->id) }}" method="post" class="d-inline m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-link text-danger p-0 text-decoration-none" onclick="return confirm('Excluir esta avaliação?')">Excluir</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info mb-0">
                    Nenhuma avaliação cadastrada para este perfume ainda.
                </div>
            @endforelse
        </div>
    </div>
</div>
@stop