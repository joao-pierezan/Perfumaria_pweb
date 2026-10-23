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

        .table tfoot th {
            border-top: 2px solid #212529;
            background-color: #e9ecef;
            font-weight: bold;
        }

        .badge-percentage {
            font-weight: bold;
            color: #0d6efd;
        }

        .summary-card {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 12px;
            margin-bottom: 20px;
        }

        .footer-note {
            margin-top: 30px;
            font-size: 11px;
            color: #777;
            text-align: right;
            border-top: 1px solid #ddd;
            padding-top: 8px;
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

    <div class="summary-card">
        <table style="width: 100%; text-align: center;">
            <tr>
                <td style="width: 33%;">
                    <span style="font-size: 12px; color: #555;">Marcas com Vendas</span><br>
                    <strong style="font-size: 16px; color: #212529;">{{ $dados->count() }}</strong>
                </td>
                <td style="width: 33%; border-left: 1px solid #ccc; border-right: 1px solid #ccc;">
                    <span style="font-size: 12px; color: #555;">Total de Vendas (Qtd.)</span><br>
                    <strong style="font-size: 16px; color: #0d6efd;">{{ $totalGeralVendas }}</strong>
                </td>
                <td style="width: 33%;">
                    <span style="font-size: 12px; color: #555;">Faturamento Bruto</span><br>
                    <strong style="font-size: 16px; color: #198754;">R$ {{ number_format($totalGeralValor, 2, ',', '.') }}</strong>
                </td>
            </tr>
        </table>
    </div>

    <div class="mt-4">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col" style="width: 5%;">#</th>
                    <th scope="col" style="width: 35%;">Marca</th>
                    <th scope="col" class="text-center" style="width: 15%;">Vendas (Bruto)</th>
                    <th scope="col" class="text-center" style="width: 15%;">% das Vendas</th>
                    <th scope="col" class="text-right" style="width: 15%;">Faturamento (R$)</th>
                    <th scope="col" class="text-center" style="width: 15%;">% Faturamento</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dados as $index => $item)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td><strong>{{ $item->marca }}</strong></td>
                        <td class="text-center">{{ $item->total_vendas }}</td>
                        <td class="text-center badge-percentage">{{ number_format($item->porcentagem_vendas, 2, ',', '.') }}%</td>
                        <td class="text-right">R$ {{ number_format($item->total_valor, 2, ',', '.') }}</td>
                        <td class="text-center text-success" style="font-weight: bold;">{{ number_format($item->porcentagem_valor, 2, ',', '.') }}%</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Nenhuma venda registrada até o momento.</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2" class="text-right">TOTAL:</th>
                    <th class="text-center">{{ $totalGeralVendas }}</th>
                    <th class="text-center">100,00%</th>
                    <th class="text-right">R$ {{ number_format($totalGeralValor, 2, ',', '.') }}</th>
                    <th class="text-center">100,00%</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="footer-note">
        Relatório gerado em {{ $date }} às {{ $hora }} pelo sistema Aromatica Perfumaria
    </div>
</body>

</html>

