@extends('main')
@section('titulo', 'Gráfico de Vendas por Marca')

@section('conteudo')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2><i class="bi bi-pie-chart-fill text-primary me-2"></i>Vendas por Marca</h2>
            <p class="text-muted mb-0">Distribuição das vendas realizadas de acordo com a marca dos perfumes</p>
        </div>
        <div>
            <a href="{{ route('vendas.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Voltar para Vendas
            </a>
            <a href="{{ url('home') }}" class="btn btn-outline-primary">
                <i class="bi bi-house me-1"></i> Início
            </a>
        </div>
    </div>

    <div class="row g-4">
        {{-- Card do Gráfico de Pizza --}}
        <div class="col-lg-7">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="card-title mb-0 fw-semibold">
                        <i class="bi bi-pie-chart me-1 text-primary"></i> Proporção de Vendas por Marca
                    </h5>
                </div>
                <div class="card-body p-4 d-flex justify-content-center align-items-center" style="min-height: 420px;">
                    {!! $chart->container() !!}
                </div>
            </div>
        </div>

        {{-- Card da Tabela de Resumo --}}
        <div class="col-lg-5">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 fw-semibold">
                        <i class="bi bi-table me-1 text-success"></i> Detalhamento por Marca
                    </h5>
                    <span class="badge bg-primary rounded-pill">{{ count($vendasPorMarca) }} marcas</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Marca</th>
                                    <th class="text-center">Qtd. Vendas</th>
                                    <th class="text-end">Total Arrecadado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $somaQtd = 0;
                                    $somaValor = 0;
                                @endphp
                                @forelse ($vendasPorMarca as $linha)
                                    @php
                                        $somaQtd += $linha->total_vendas;
                                        $somaValor += $linha->total_valor;
                                    @endphp
                                    <tr>
                                        <td class="fw-medium text-dark">{{ $linha->marca }}</td>
                                        <td class="text-center">
                                            <span class="badge bg-secondary-subtle text-secondary border px-2 py-1">
                                                {{ $linha->total_vendas }}
                                            </span>
                                        </td>
                                        <td class="text-end fw-semibold text-success">
                                            R$ {{ number_format($linha->total_valor, 2, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted py-4">Nenhum dado encontrado.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if(count($vendasPorMarca) > 0)
                                <tfoot class="table-light fw-bold">
                                    <tr>
                                        <td>TOTAL GERAL</td>
                                        <td class="text-center">{{ $somaQtd }}</td>
                                        <td class="text-end text-success">R$ {{ number_format($somaValor, 2, ',', '.') }}</td>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Scripts do ApexCharts e do LarapexChart --}}
<script src="{{ $chart->cdn() }}"></script>
{{ $chart->script() }}
@stop

