@extends('main')
@section('titulo', 'Aromatica Perfumaria - Início')
@section('conteudo')

    {{-- HERO SECTION --}}
    <div class="p-5 mb-5 rounded-4 shadow-sm text-white" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill mb-3 fw-semibold">
                    <i class="bi bi-stars me-1"></i> Alta Perfumaria Autoral
                </span>
                <h1 class="display-4 fw-bold mb-3">Aromatica</h1>
                <p class="fs-5 text-light opacity-75 mb-4">
                    A arte de deixar marcas. Descubra fragrâncias exclusivas, explore cada camada da pirâmide olfativa
                    e compartilhe suas percepções com a nossa comunidade de apreciadores.
                </p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ url('perfume') }}" class="btn btn-warning btn-lg px-4 fw-semibold shadow-sm">
                        <i class="bi bi-droplet-half me-1"></i> Explorar Catálogo
                    </a>
                    <a href="{{ url('notas') }}" class="btn btn-outline-light btn-lg px-4">
                        <i class="bi bi-flower1 me-1"></i> Acervo de Notas
                    </a>
                </div>
            </div>
            <div class="col-lg-4 text-center d-none d-lg-block">
                <div class="p-3 bg-white bg-opacity-10 rounded-circle d-inline-block border border-light border-opacity-25 shadow">
                    <img src="{{ asset('img/aromatica.jpg') }}" alt="Aromatica" class="rounded-circle img-fluid" style="width: 170px; height: 170px; object-fit: cover;">
                </div>
            </div>
        </div>
    </div>

    {{-- CARDS DE ACESSO RÁPIDO / MÉTRICAS --}}
    <div class="row g-3 mb-5">
        <div class="col-sm-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm rounded-3">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-3 me-3 fs-3">
                        <i class="bi bi-droplet-fill"></i>
                    </div>
                    <div>
                        <div class="text-muted small text-uppercase fw-semibold">Perfumes</div>
                        <h3 class="fw-bold mb-0">{{ $totalPerfumes }}</h3>
                        <a href="{{ url('perfume') }}" class="stretched-link text-decoration-none small text-primary fw-medium">Ver catálogo &rarr;</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm rounded-3">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 text-success p-3 rounded-3 me-3 fs-3">
                        <i class="bi bi-flower2"></i>
                    </div>
                    <div>
                        <div class="text-muted small text-uppercase fw-semibold">Notas Olfativas</div>
                        <h3 class="fw-bold mb-0">{{ $totalNotas }}</h3>
                        <a href="{{ url('notas') }}" class="stretched-link text-decoration-none small text-success fw-medium">Explorar notas &rarr;</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm rounded-3">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-3 me-3 fs-3">
                        <i class="bi bi-chat-heart-fill"></i>
                    </div>
                    <div>
                        <div class="text-muted small text-uppercase fw-semibold">Avaliações</div>
                        <h3 class="fw-bold mb-0">{{ $totalAvaliacoes }}</h3>
                        <a href="{{ url('avaliacoes') }}" class="stretched-link text-decoration-none small text-warning fw-medium">Ler opiniões &rarr;</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm rounded-3">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-info bg-opacity-10 text-info p-3 rounded-3 me-3 fs-3">
                        <i class="bi bi-bag-check-fill"></i>
                    </div>
                    <div>
                        <div class="text-muted small text-uppercase fw-semibold">Vendas</div>
                        <h3 class="fw-bold mb-0">{{ $totalVendas }}</h3>
                        <a href="{{ url('vendas') }}" class="stretched-link text-decoration-none small text-info fw-medium">Gerenciar pedidos &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- VITRINE: PERFUMES EM DESTAQUE --}}
    <div class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1">Fragrâncias em Destaque</h3>
                <p class="text-muted mb-0">Seleção exclusiva de perfumes da nossa coleção autoral</p>
            </div>
            <a href="{{ url('perfume') }}" class="btn btn-outline-dark btn-sm">
                Ver todos os perfumes <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
            @forelse ($destaques as $item)
                @php
                    $imagemPerfume = asset('images/sem-foto.avif');
                    if (!empty($item->imagem)) {
                        if (file_exists(public_path('storage/' . $item->imagem)) || file_exists(storage_path('app/public/' . $item->imagem))) {
                            $imagemPerfume = asset('storage/' . $item->imagem);
                        } elseif (file_exists(public_path('imagens/' . $item->imagem))) {
                            $imagemPerfume = asset('imagens/' . $item->imagem);
                        }
                    }
                @endphp
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden d-flex flex-column">
                        <div class="bg-light p-3 text-center border-bottom d-flex align-items-center justify-content-center position-relative" style="height: 220px;">
                            <img src="{{ $imagemPerfume }}" alt="{{ $item->nome }}" class="img-fluid mh-100" style="object-fit: contain;">
                            <span class="badge bg-dark position-absolute top-0 end-0 m-2">{{ $item->volume }}</span>
                        </div>
                        <div class="card-body d-flex flex-column text-center p-3">
                            <small class="text-muted text-uppercase fw-semibold mb-1">{{ $item->marca }}</small>
                            <h5 class="card-title fw-bold text-dark mb-1">{{ $item->nome }}</h5>
                            <div class="mb-2">
                                <span class="badge bg-secondary-subtle text-secondary border">{{ $item->familia_olfativa }}</span>
                            </div>

                            <div class="mt-auto pt-3 border-top">
                                <div class="text-success fw-bold fs-5 mb-2">
                                    R$ {{ number_format((float)$item->preco, 2, ',', '.') }}
                                </div>
                                <a href="{{ route('perfume.show', $item->id) }}" class="btn btn-dark w-100 btn-sm fw-medium">
                                    <i class="bi bi-eye me-1"></i> Ver Pirâmide
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-light border text-center py-4">
                        Nenhum perfume cadastrado no momento.
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    {{-- PIRÂMIDE OLFATIVA INFOGRÁFICO --}}
    <div class="card border-0 shadow-sm rounded-4 mb-5 bg-light p-4">
        <div class="row align-items-center g-4">
            <div class="col-lg-4 text-center text-lg-start">
                <span class="badge bg-secondary text-white px-3 py-1 rounded-pill mb-2">Estrutura Olfativa</span>
                <h3 class="fw-bold mb-2">Como Nossos Perfumes São Construídos</h3>
                <p class="text-muted mb-3">
                    Cada criação autoral segue a harmonia clássica da perfumaria de nicho, equilibrando notas voláteis, corpo aromático e base aveludada.
                </p>
                <a href="{{ url('notas') }}" class="btn btn-outline-dark">
                    <i class="bi bi-palette me-1"></i> Conhecer as Notas
                </a>
            </div>
            <div class="col-lg-8">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm p-3 bg-white rounded-3 border-start border-4 border-warning">
                            <h6 class="fw-bold text-warning-emphasis mb-1">
                                <i class="bi bi-sunrise me-1"></i> Notas de Topo
                            </h6>
                            <small class="text-muted d-block mb-2">Primeiros 15 a 30 minutos</small>
                            <p class="small text-muted mb-0">Cítricas e aromáticas frescas. A primeira impressão ao borrifar o perfume.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm p-3 bg-white rounded-3 border-start border-4 border-danger">
                            <h6 class="fw-bold text-danger-emphasis mb-1">
                                <i class="bi bi-heart me-1"></i> Notas de Coração
                            </h6>
                            <small class="text-muted d-block mb-2">Duram de 2 a 4 horas</small>
                            <p class="small text-muted mb-0">Florais, frutadas e especiadas. Definem a identidade e a personalidade da fragrância.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm p-3 bg-white rounded-3 border-start border-4 border-dark">
                            <h6 class="fw-bold text-dark mb-1">
                                <i class="bi bi-shield-lock me-1"></i> Notas de Fundo
                            </h6>
                            <small class="text-muted d-block mb-2">Fixação de 6 a 12 horas</small>
                            <p class="small text-muted mb-0">Madeiras nobres, âmbar e baunilha. Dão solidez, peso e rastro marcante.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ÚLTIMAS AVALIAÇÕES DA COMUNIDADE --}}
    @if ($ultimasAvaliacoes->isNotEmpty())
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold mb-1">O Que Dizem os Nossos Clientes</h3>
                    <p class="text-muted mb-0">Avaliações reais compartilhadas pela comunidade</p>
                </div>
                <a href="{{ url('avaliacoes') }}" class="btn btn-outline-dark btn-sm">
                    Ver todas as avaliações <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <div class="row g-3">
                @foreach ($ultimasAvaliacoes as $avaliacao)
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm rounded-3 p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-warning text-dark fw-bold">
                                    ★ {{ number_format((float)$avaliacao->nota, 1) }} / 10
                                </span>
                                <small class="text-muted">{{ $avaliacao->created_at ? $avaliacao->created_at->diffForHumans() : 'Recentemente' }}</small>
                            </div>
                            <h6 class="fw-bold text-dark mb-1">
                                {{ $avaliacao->perfumeRelacionado ? $avaliacao->perfumeRelacionado->nome : 'Perfume Especial' }}
                            </h6>
                            <p class="text-muted small fst-italic flex-grow-1 mb-2">
                                "{{ Str::limit($avaliacao->texto, 120) }}"
                            </p>
                            <div class="border-top pt-2 mt-auto d-flex align-items-center gap-2">
                                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 28px; height: 28px; font-size: 12px;">
                                    {{ strtoupper(substr($avaliacao->usuario?->nome ?? 'C', 0, 1)) }}
                                </div>
                                <small class="text-muted fw-semibold">
                                    {{ $avaliacao->usuario?->nome ?? 'Cliente Anônimo' }}
                                </small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

@stop