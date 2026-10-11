@extends('main')
@section('titulo', 'Catálogo de Perfumes')
@section('conteudo')

    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h3>Catálogo de Perfumes</h3>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ url('perfume/create') }}" class="btn btn-success">+ Novo Perfume</a>
        </div>
    </div>

    <form action="{{ route('perfume.search') }}" method="post" class="mb-4">
        @csrf
        <div class="row g-2">
            <div class="col-md-3">
                <select name="tipo" class="form-select">
                    <option value="nome">Nome</option>
                    <option value="marca">Marca</option>
                    <option value="preco">Preço</option>
                </select>
            </div>
            <div class="col-md-7">
                <input type="text" name="valor" placeholder="Pesquisar por perfume, marca..." class="form-control">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Buscar</button>
            </div>
        </div>
    </form>

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
    @foreach ($dados as $item)
        @php
            $nomeArquivoMarca = 'Imagens/' . $item->marca . '.webp';
            $imagemPerfume = !empty($item->imagem)
                ? asset('storage/' . $item->imagem)
                : (file_exists(public_path($nomeArquivoMarca))
                    ? asset($nomeArquivoMarca)
                    : asset('img/aromatica.jpg'));
        @endphp
        <div class="col">
            <div class="card h-100 border shadow-sm">
                <!-- Imagem do Perfume -->
                <div class="bg-light text-center p-3 border-bottom d-flex align-items-center justify-content-center" style="height: 200px;">
                    <img src="{{ $imagemPerfume }}"
                        alt="{{ $item->nome }}" 
                        class="img-fluid mh-100" 
                        style="object-fit: contain;">
                </div>

                <!-- Detalhes: Marca, Nome e Preço -->
                <div class="card-body d-flex flex-column text-center">
                    <small class="text-muted text-uppercase fw-bold mb-1">{{ $item->marca }}</small>
                    <h5 class="card-title fw-semibold mb-2">{{ $item->nome }}</h5>
                    
                    <div class="mt-auto pt-2">
                        <span class="fs-6 text-muted">Preço:</span>
                        <h4 class="text-success fw-bold mb-3">R$ {{ number_format((float)$item->preco, 2, ',', '.') }}</h4>
                        
                        <!-- Botão Comprar -->
                        <a href="{{ route('perfume.show', $item->id) }}" class="btn btn-primary w-100 fw-bold">
                            Comprar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

    <!-- Mensagem de lista vazia -->
    @if($dados->isEmpty())
        <div class="alert alert-info mt-4">
            Nenhum perfume encontrado no catálogo.
        </div>
    @endif

@stop