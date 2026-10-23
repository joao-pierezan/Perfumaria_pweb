<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $titulo }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            color: #333;
            font-size: 13px;
        }

        .header-box {
            border-bottom: 2px solid #212529;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }

        .report-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 4px;
            color: #1a1a1a;
        }

        .report-subtitle {
            font-size: 13px;
            color: #666;
        }

        .info-box {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 12px 15px;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 8px 10px;
            vertical-align: middle;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #212529;
            background-color: #f8f9fa;
            color: #212529;
            font-size: 13px;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, .03);
        }

        .badge-curto {
            background-color: #6c757d;
            color: #fff;
            padding: 3px 7px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: bold;
        }

        .badge-medio {
            background-color: #17a2b8;
            color: #fff;
            padding: 3px 7px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: bold;
        }

        .badge-longo {
            background-color: #28a745;
            color: #fff;
            padding: 3px 7px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: bold;
        }

        .bar-container {
            width: 100%;
            background-color: #e9ecef;
            border-radius: 3px;
            height: 12px;
            overflow: hidden;
            display: inline-block;
        }

        .bar-fill {
            height: 12px;
            background-color: #17a2b8;
        }

        .footer-note {
            margin-top: 30px;
            font-size: 11px;
            color: #777;
            text-align: right;
            border-top: 1px solid #ddd;
            padding-top: 8px;
        }

        .section-heading {
            font-size: 15px;
            font-weight: bold;
            color: #212529;
            margin-top: 20px;
            margin-bottom: 10px;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="header-box">
        <table style="width: 100%;">
            <tr>
                <td style="vertical-align: middle;">
                    <div class="report-title">Aromatica Perfumaria</div>
                    <div class="report-subtitle">{{ $titulo }}</div>
                </td>
                <td style="text-align: right; vertical-align: middle;">
                    <span style="font-size: 12px; color: #555;">Data: {{ $date }} às {{ $hora }}</span>
                </td>
            </tr>
        </table>
    </div>

    <!-- Dados do Perfume -->
    <div class="info-box">
        <table style="width: 100%;">
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <strong>Perfume:</strong> {{ $perfume->nome }}<br>
                    <strong>Marca:</strong> {{ $perfume->marca }}<br>
                    <strong>Família Olfativa:</strong> {{ $perfume->familia_olfativa }}
                </td>
                <td style="width: 50%; vertical-align: top;">
                    <strong>Volume:</strong> {{ $perfume->volume }}<br>
                    <strong>Preço:</strong> R$ {{ number_format((float) $perfume->preco, 2, ',', '.') }}<br>
                    <strong>Nota Média:</strong> {{ $mediaNota !== null ? $mediaNota . ' / 10' : 'Sem notas' }} ({{ $avaliacoes->count() }} avaliações)
                </td>
            </tr>
        </table>
    </div>

    <!-- Seção: Análise de Longevidade -->
    <div class="section-heading">Distribuição de Longevidade (Votos dos Usuários)</div>

    <table class="table table-striped table-hover mb-4">
        <thead>
            <tr>
                <th scope="col" style="width: 25%;">Classificação</th>
                <th scope="col" style="width: 20%;">Faixa de Duração</th>
                <th scope="col" class="text-center" style="width: 15%;">Votos (Brutos)</th>
                <th scope="col" class="text-center" style="width: 15%;">Porcentagem</th>
                <th scope="col" style="width: 25%;">Distribuição</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><span class="badge-curto">Fixação Curta</span></td>
                <td>1 a 3 horas</td>
                <td class="text-center font-weight-bold">{{ $votosCurto }}</td>
                <td class="text-center font-weight-bold text-secondary">{{ $percCurto }}%</td>
                <td>
                    <div class="bar-container">
                        <div class="bar-fill" style="width: {{ $percCurto }}%; background-color: #6c757d;"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td><span class="badge-medio">Fixação Moderada</span></td>
                <td>4 a 7 horas</td>
                <td class="text-center font-weight-bold">{{ $votosMedio }}</td>
                <td class="text-center font-weight-bold text-info">{{ $percMedio }}%</td>
                <td>
                    <div class="bar-container">
                        <div class="bar-fill" style="width: {{ $percMedio }}%; background-color: #17a2b8;"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td><span class="badge-longo">Fixação Longa</span></td>
                <td>8 ou mais horas</td>
                <td class="text-center font-weight-bold">{{ $votosLongo }}</td>
                <td class="text-center font-weight-bold text-success">{{ $percLongo }}%</td>
                <td>
                    <div class="bar-container">
                        <div class="bar-fill" style="width: {{ $percLongo }}%; background-color: #28a745;"></div>
                    </div>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr style="background-color: #f1f3f5; font-weight: bold;">
                <td colspan="2">Consenso Predominante: <strong>{{ $longevidadePredominante }}</strong></td>
                <td class="text-center">Total: {{ $totalVotos }}</td>
                <td class="text-center">100%</td>
                <td></td>
            </tr>
        </tfoot>
    </table>

    <!-- Seção: Avaliações Individuais -->
    <div class="section-heading">Histórico de Avaliações e Votos de Longevidade</div>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col" style="width: 5%;">#</th>
                <th scope="col" style="width: 20%;">Avaliador</th>
                <th scope="col" class="text-center" style="width: 12%;">Data</th>
                <th scope="col" class="text-center" style="width: 10%;">Nota</th>
                <th scope="col" class="text-center" style="width: 18%;">Longevidade</th>
                <th scope="col" style="width: 35%;">Resenha / Comentário</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($avaliacoes as $index => $av)
                <tr>
                    <th scope="row">{{ $index + 1 }}</th>
                    <td><strong>{{ $av->usuario?->nome ?? 'Usuário anônimo' }}</strong></td>
                    <td class="text-center">{{ $av->created_at?->format('d/m/Y') ?? '-' }}</td>
                    <td class="text-center font-weight-bold text-warning">{{ $av->nota }} / 10</td>
                    <td class="text-center">
                        @if ($av->longevidade === 'curto')
                            <span class="badge-curto">Curta (1-3h)</span>
                        @elseif ($av->longevidade === 'medio')
                            <span class="badge-medio">Moderada (4-7h)</span>
                        @elseif ($av->longevidade === 'longo')
                            <span class="badge-longo">Longa (8h+)</span>
                        @else
                            <span class="badge badge-light border">{{ ucfirst($av->longevidade ?? '-') }}</span>
                        @endif
                    </td>
                    <td>{{ $av->texto }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-3">
                        Nenhuma avaliação registrada para este perfume até o momento.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer-note">
        Relatório gerado em {{ $date }} às {{ $hora }} pelo sistema Aromatica Perfumaria
    </div>
</body>

</html>

