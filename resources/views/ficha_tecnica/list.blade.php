@foreach($dados as $perfume)
    <tr>
        <td>{{ $perfume->nome }}</td>
        <td>{{ $perfume->marca }}</td>
        <!-- Exibindo dados da tabela relacionada (1:1) -->
        <td>{{ $perfume->fichaTecnica->notas_topo ?? 'N/A' }}</td>
        <td>{{ $perfume->fichaTecnica->notas_coracao ?? 'N/A' }}</td>
        <td>
            <!-- botões de ação -->
        </td>
    </tr>
@endforeach