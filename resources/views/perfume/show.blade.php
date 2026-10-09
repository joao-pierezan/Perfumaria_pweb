@extends('main')
@section('titulo', 'Detalhes do Perfume')
@section('conteudo')
<div class="container">
    <h2>Detalhes do Perfume</h2>
    <hr>
    <p><strong>Perfume:</strong> {{ $item->nome }}</p>
    <p><strong>Marca:</strong> {{ $item->marca }}</p>
    <p><strong>Família Olfativa:</strong> {{ $item->familia_olfativa }}</p>
    <p><strong>Volume:</strong> {{ $item->volume }}</p>
    <p><strong>Preço:</strong> R$ {{ number_format((float)$item->preco, 2, ',', '.') }}</p>
    
    <div class="card mt-3">
        <div class="card-header">
            <h5 class="mb-0">Ficha Técnica (Notas Olfativas)</h5>
        </div>
        <div class="card-body">
            <p><strong>Notas de Topo:</strong> {{ $item->fichaTecnica?->notas_topo ?? 'Não informada' }}</p>
            <p><strong>Notas de Coração:</strong> {{ $item->fichaTecnica?->notas_coracao ?? 'Não informada' }}</p>
            <p><strong>Notas de Base:</strong> {{ $item->fichaTecnica?->notas_base ?? 'Não informada' }}</p>
        </div>
    </div>

    <a href="{{ url('perfume') }}" class="btn btn-secondary mt-3">Voltar</a>
</div>
@stop