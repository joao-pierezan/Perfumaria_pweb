@extends('main')
@section('titulo', $item->nome . ' - Detalhes do Perfume')
@section('conteudo')

@php
    $nomeArquivoMarca = 'Imagens/' . $item->marca . '.webp';
    $imagemPerfume = !empty($item->imagem)
        ? asset('storage/' . $item->imagem)
        : (file_exists(public_path($nomeArquivoMarca))
            ? asset($nomeArquivoMarca)
            : asset('img/aromatica.jpg'));
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
                <button type="button" class="btn btn-primary btn-lg px-4 fw-bold">
                    Comprar Agora
                </button>
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

    <!-- Seção: Notas Olfativas (Pirâmide Olfativa - Estilo Fragrantica Oficial) -->
    <div class="card shadow-sm border mb-5">
        <div class="card-header bg-light py-3 text-center">
            <h4 class="mb-0 fw-bold">Pirâmide Olfativa</h4>
            <small class="text-muted">Notas olfativas e evolução da fragrância</small>
        </div>
        <div class="card-body p-4 bg-white">
            
            <!-- TOP NOTES -->
            <div class="mb-4">
                <div class="d-flex align-items-center justify-content-center my-3">
                    <div class="border-top flex-grow-1"></div>
                    <span class="px-3 text-secondary text-uppercase fw-bold" style="letter-spacing: 2px; font-size: 0.85rem;">
                        TOP NOTES
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

            <!-- MIDDLE NOTES -->
            <div class="mb-4">
                <div class="d-flex align-items-center justify-content-center my-3">
                    <div class="border-top flex-grow-1"></div>
                    <span class="px-3 text-secondary text-uppercase fw-bold" style="letter-spacing: 2px; font-size: 0.85rem;">
                        MIDDLE NOTES
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

            <!-- BASE NOTES -->
            <div>
                <div class="d-flex align-items-center justify-content-center my-3">
                    <div class="border-top flex-grow-1"></div>
                    <span class="px-3 text-secondary text-uppercase fw-bold" style="letter-spacing: 2px; font-size: 0.85rem;">
                        BASE NOTES
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

    <!-- Seção: Avaliações do Perfume (Relacionamento 1:N) -->
    <div class="card shadow-sm border mb-4">
        <div class="card-header bg-light py-3 d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-0 fw-bold">Avaliações dos Usuários</h4>
                <small class="text-muted">Total de avaliações: {{ $item->avaliacoes->count() }}</small>
            </div>
            <a href="{{ route('avaliacoes.create') }}" class="btn btn-success btn-sm">
                + Nova Avaliação
            </a>
        </div>
        <div class="card-body p-4">
            @forelse ($item->avaliacoes as $avaliacao)
                <div class="card mb-3 border bg-white">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $avaliacao->usuario?->nome ?? 'Usuário Anônimo' }}</strong>
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