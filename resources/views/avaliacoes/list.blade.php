@extends('main')
@section('titulo', 'Listagem de Avaliações')
@section('conteudo')
    <div class="container mt-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
            <div>
                <h2 class="mb-0">Listagem de Avaliações</h2>
                <small class="text-muted">Todas as avaliações possuem relacionamento 1:1 com suas respectivas vendas</small>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('avaliacoes.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-lg me-1"></i> Nova Avaliação
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Formulário de Busca -->
        <form action="{{ route('avaliacoes.search') }}" method="post" class="card shadow-sm border p-3 mb-4 bg-light">
            @csrf
            <div class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label for="tipo" class="form-label small fw-bold text-muted">Pesquisar por</label>
                    <select name="tipo" class="form-select">
                        <option value="perfume" {{ request('tipo') === 'perfume' ? 'selected' : '' }}>Perfume / Marca</option>
                        <option value="autor" {{ request('tipo') === 'autor' ? 'selected' : '' }}>Autor / Usuário</option>
                        <option value="nota" {{ request('tipo') === 'nota' ? 'selected' : '' }}>Nota</option>
                        <option value="texto" {{ request('tipo') === 'texto' ? 'selected' : '' }}>Texto da Resenha</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="valor" class="form-label small fw-bold text-muted">Termo de Busca</label>
                    <input type="text" name="valor" value="{{ request('valor') }}" placeholder="Digite para buscar..." class="form-control">
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">Buscar</button>
                    @if(request('valor'))
                        <a href="{{ route('avaliacoes.index') }}" class="btn btn-outline-secondary">Limpar</a>
                    @endif
                </div>
            </div>
        </form>

        <!-- Listagem de Resenhas -->
        <div class="row g-3 mb-5">
            @forelse ($dados as $item)
                @php
                    $nomePerfume = $item->perfumeRelacionado 
                        ? trim(($item->perfumeRelacionado->marca ?? '') . ' ' . ($item->perfumeRelacionado->nome ?? '')) 
                        : 'Perfume #' . $item->perfume;

                    $mapLongevidade = [
                        'curto' => ['label' => 'Fixação Curta (1-3h)', 'class' => 'bg-secondary-subtle text-secondary border'],
                        'medio' => ['label' => 'Fixação Moderada (4-7h)', 'class' => 'bg-info-subtle text-info-emphasis border'],
                        'longo' => ['label' => 'Fixação Longa (8h+)', 'class' => 'bg-success-subtle text-success-emphasis border'],
                    ];
                    $badgeLong = $mapLongevidade[$item->longevidade] ?? ['label' => ucfirst($item->longevidade ?? '-'), 'class' => 'bg-light text-dark border'];
                @endphp
                <div class="col-12">
                    <div class="card shadow-sm border rounded-3 bg-white">
                        <div class="card-header bg-light py-2 d-flex flex-wrap justify-content-between align-items-center gap-2">
                            <div class="d-flex align-items-center gap-2">
                                <h5 class="mb-0 fw-bold text-dark">
                                    @if($item->perfumeRelacionado)
                                        <a href="{{ route('perfume.show', $item->perfumeRelacionado->id) }}" class="text-decoration-none text-dark">
                                            {{ $nomePerfume }}
                                        </a>
                                    @else
                                        {{ $nomePerfume }}
                                    @endif
                                </h5>
                                
                                <span class="badge {{ $badgeLong['class'] }}">
                                    <i class="bi bi-clock-history me-1"></i>{{ $badgeLong['label'] }}
                                </span>

                                @if($item->venda)
                                    <span class="badge bg-primary-subtle text-primary border" title="Relacionamento 1:1 com Venda">
                                        <i class="bi bi-receipt me-1"></i>Venda #{{ $item->venda->id }} (R$ {{ number_format($item->venda->valor_total, 2, ',', '.') }})
                                    </span>
                                @endif
                            </div>

                            <span class="badge bg-warning text-dark fs-6 px-3 py-1">
                                Nota: {{ $item->nota }} / 10
                            </span>
                        </div>

                        <div class="card-body py-3">
                            <p class="card-text fs-6 mb-0" style="white-space: pre-line;">{{ $item->texto }}</p>
                        </div>

                        <div class="card-footer bg-white border-top py-2 d-flex flex-wrap justify-content-between align-items-center gap-2 text-muted" style="font-size: 0.85rem;">
                            <div>
                                <strong>Avaliador:</strong> {{ $item->usuario->nome ?? 'Usuário anônimo' }} 
                                &bull; <span>Data: {{ $item->created_at?->format('d/m/Y') ?? 'N/A' }}</span>
                            </div>

                            <div class="d-flex gap-2">
                                <a href="{{ route('avaliacoes.edit', $item->id) }}" class="btn btn-sm btn-outline-warning">Editar</a>
                                <form action="{{ route('avaliacoes.destroy', $item->id) }}" method="post" class="d-inline m-0" onsubmit="return confirm('Deseja excluir esta avaliação? Isso também removerá a venda vinculada (relação 1:1).')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        Nenhuma avaliação encontrada.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@stop

