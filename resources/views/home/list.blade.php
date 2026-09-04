@extends('main')
@section('titulo', 'Aromatica Perfumaria')
@section('conteudo')
    <div class="p-5 mb-4 bg-light rounded-3 border">
        <div class="container-fluid py-3">
            <h1 class="display-5 fw-bold">Carborezan Perfumaria</h1>
            <p class="col-md-8 fs-4">A Arte de Deixar Marcas. Fragrâncias autorais desenvolvidas por João Vitor e Pedro.</p>
            <a href="{{ url('perfume') }}" class="btn btn-primary btn-lg">Ver Catálogo / Gerenciar</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Linha Assinatura</h5>
                    <p class="card-text">Perfumes marcantes e intensos para ocasiões especiais.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Linha Essencial</h5>
                    <p class="card-text">Combinações sofisticadas para o estilo do dia a dia.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Edições Limitadas</h5>
                    <p class="card-text">Lotes exclusivos e numerados com ingredientes raros.</p>
                </div>
            </div>
        </div>
    </div>
@stop