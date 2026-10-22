@extends('main')
@section('titulo', 'Comprar o perfume ' . $item->nome)
@section('conteudo')

<div class="container py-3">
    <div class="mb-3">
        <a href="{{ url('perfume') }}" class="btn btn-outline-secondary btn-sm">
            &larr; Voltar ao Catálogo
        </a>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm bg-light text-center p-4 d-flex align-items-center justify-content-center" style="min-height: 380px;">
                <img src="{{ asset('storage/' . $item->imagem) }}" 
                     alt="{{ $item->nome }}" 
                     class="img-fluid rounded" 
                     style="max-height: 350px; object-fit: contain;">
            </div>
        </div>

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

            <div class="pt-3 border-top d-flex flex-wrap gap-2 align-items-center">
                <a href="{{ url('vendas/create?perfume_id=' . $item->id) }}" class="btn btn-primary btn-lg px-4 fw-bold">
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
                        <div class="text-center" style="width: 90px;">
                            <div class="bg-white border rounded-3 p-1 shadow-sm d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 72px; height: 72px;">
                                <img src="{{ !empty($nota->imagem) ? asset('storage/' . $nota->imagem) : asset('img/aromatica.jpg') }}" alt="{{ $nota->nome }}" class="w-100 h-100 rounded" style="object-fit: cover;">
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
                        <div class="text-center" style="width: 90px;">
                            <div class="bg-white border rounded-3 p-1 shadow-sm d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 72px; height: 72px;">
                                <img src="{{ !empty($nota->imagem) ? asset('storage/' . $nota->imagem) : asset('img/aromatica.jpg') }}" alt="{{ $nota->nome }}" class="w-100 h-100 rounded" style="object-fit: cover;">
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
                        <div class="text-center" style="width: 90px;">
                            <div class="bg-white border rounded-3 p-1 shadow-sm d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 72px; height: 72px;">
                                <img src="{{ !empty($nota->imagem) ? asset('storage/' . $nota->imagem) : asset('img/aromatica.jpg') }}" alt="{{ $nota->nome }}" class="w-100 h-100 rounded" style="object-fit: cover;">
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
    @php
        $vCurto = $votosLongevidade['curto'] ?? 0;
        $vMedio = $votosLongevidade['medio'] ?? 0;
        $vLongo = $votosLongevidade['longo'] ?? 0;
        $totVotos = $totalVotosLongevidade ?? ($vCurto + $vMedio + $vLongo);

        $pCurto = $totVotos > 0 ? round(($vCurto / $totVotos) * 100) : 0;
        $pMedio = $totVotos > 0 ? round(($vMedio / $totVotos) * 100) : 0;
        $pLongo = $totVotos > 0 ? round(($vLongo / $totVotos) * 100) : 0;
    @endphp

    <div class="card shadow-sm border rounded-4 mb-5 bg-white p-4">
        <div class="text-center mb-3">
            {{-- Ícone Relógio Estilo Fragrantica --}}
            <div class="mb-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" fill="#555" class="bi bi-clock-history" viewBox="0 0 16 16">
                    <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976q.576.129 1.123.331zm2.437 1.353a7 7 0 0 0-.82-.622l.484-.874a8 8 0 0 1 1.002.756l-.666.74zm1.905 2.193a7 7 0 0 0-.583-.846l.74-.666a8 8 0 0 1 .715.998l-.872.514zm1.096 2.45a7 7 0 0 0-.294-.987l.977-.217a8 8 0 0 1 .353 1.126zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                </svg>
            </div>
            <h6 class="fw-bold text-uppercase mb-0 text-secondary" style="letter-spacing: 2px;">Logevidade</h6>
            <small class="text-muted">Longevidade del perfume </small>
        </div>  

        <div class="mx-auto" style="width: 100%; max-width: 550px;">
            {{-- Opção 1: Curto --}}
            <div class="row align-items-center mb-3">
                <div class="col-4 text-secondary fw-semibold text-nowrap">
                    Curta duração
                </div>
                <div class="col-2 text-center text-muted fw-bold">
                    {{ $vCurto }}
                </div>
                <div class="col-6">
                    <div class="progress" style="height: 14px; background-color: #e9ecef; border-radius: 20px;">
                        <div class="progress-bar rounded-pill" role="progressbar" 
                             style="width: {{ $pCurto }}%; background-color: #29c2d6;" 
                             aria-valuenow="{{ $pCurto }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>

            {{-- Opção 2: Médio --}}
            <div class="row align-items-center mb-3">
                <div class="col-4 text-secondary fw-semibold text-nowrap">
                    Duração moderada
                </div>
                <div class="col-2 text-center text-muted fw-bold">
                    {{ $vMedio }}
                </div>
                <div class="col-6">
                    <div class="progress" style="height: 14px; background-color: #e9ecef; border-radius: 20px;">
                        <div class="progress-bar rounded-pill" role="progressbar" 
                             style="width: {{ $pMedio }}%; background-color: #29c2d6;" 
                             aria-valuenow="{{ $pMedio }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>

            <div class="row align-items-center mb-2">
                <div class="col-4 text-secondary fw-semibold text-nowrap">
                    Longa duração
                </div>
                <div class="col-2 text-center text-muted fw-bold">
                    {{ $vLongo }}
                </div>
                <div class="col-6">
                    <div class="progress" style="height: 14px; background-color: #e9ecef; border-radius: 20px;">
                        <div class="progress-bar rounded-pill" role="progressbar" 
                             style="width: {{ $pLongo }}%; background-color: #29c2d6;" 
                             aria-valuenow="{{ $pLongo }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
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
                        <div class="d-flex align-items-center gap-2">
                            <strong>{{ $avaliacao->usuario?->nome }}</strong>
                            @if(!empty($avaliacao->longevidade))
                                @php
                                    $mapLongevidade = [
                                        'curto' => ['label' => 'Fixação Curta (1-3h)', 'class' => 'bg-secondary-subtle text-secondary'],
                                        'medio' => ['label' => 'Fixação Moderada (4-7h)', 'class' => 'bg-info-subtle text-info-emphasis'],
                                        'longo' => ['label' => 'Fixação Longa (8h+)', 'class' => 'bg-success-subtle text-success-emphasis'],
                                    ];
                                    $cfg = $mapLongevidade[$avaliacao->longevidade] ?? ['label' => ucfirst($avaliacao->longevidade), 'class' => 'bg-light text-dark'];
                                @endphp
                                <span class="badge {{ $cfg['class'] }} border">
                                    <i class="bi bi-clock-history me-1"></i>{{ $cfg['label'] }}
                                </span>
                            @endif
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