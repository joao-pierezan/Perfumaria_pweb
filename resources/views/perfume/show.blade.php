
@section('content')
<div class="container">
    <h2>Detalhes da Ficha Técnica</h2>
    <hr>
    <p><strong>Perfume:</strong> {{ $item->nome }}</p>
    <p><strong>Marca:</strong> {{ $item->marca }}</p>
    <p><strong>Família Olfativa:</strong> {{ $item->familia_olfativa }}</p>
    
    <div class="card mt-3">
        <div class="card-body">
            <h4>Notas Olfativas</h4>
            <p><strong>Notas de Topo:</strong> {{ $item->fichaTecnica->notas_topo ?? 'Não informada' }}</p>
            <p><strong>Notas de Coração:</strong> {{ $item->fichaTecnica->notas_coracao ?? 'Não informada' }}</p>
            <p><strong>Notas de Base:</strong> {{ $item->fichaTecnica->notas_base ?? 'Não informada' }}</p>
        </div>
    </div>

    <a href="{{ url('perfume') }}" class="btn btn-secondary mt-3">Voltar</a>
</div>
@endsection