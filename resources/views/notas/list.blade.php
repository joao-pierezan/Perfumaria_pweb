@extends('main')
@section('titulo', 'Notas Olfativas')
@section('conteudo')

    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h3>Notas Olfativas</h3>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('notas.create') }}" class="btn btn-success">+ Nova Nota</a>
        </div>
    </div>

    <!-- Formulário de Busca -->
    <form action="{{ route('notas.search') }}" method="post" class="mb-4">
        @csrf
        <div class="row g-2">
            <div class="col-md-3">
                <select name="tipo" class="form-select">
                    <option value="nome">Nome</option>
                    <option value="descricao">Descrição</option>
                </select>
            </div>
            <div class="col-md-7">
                <input type="text" name="valor" placeholder="Pesquisar por nome ou descrição..." class="form-control">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Buscar</button>
            </div>
        </div>
    </form>

    <!-- Grid de Cards de Notas Olfativas -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @foreach ($dados as $item)
            @php
                $srcImagem = asset('img/aromatica.jpg');
                if (!empty($item->imagem)) {
                    if (file_exists(public_path($item->imagem))) {
                        $srcImagem = asset($item->imagem);
                    } elseif (file_exists(public_path('notas/' . $item->imagem))) {
                        $srcImagem = asset('imagensNotas/' . $item->imagem);
                    } elseif (file_exists(public_path('storage/' . $item->imagem))) {
                        $srcImagem = asset('storage/' . $item->imagem);
                    }
                }
            @endphp
            <div class="col">
                <div class="card h-100 border shadow-sm">
                    <!-- Imagem da Nota -->
                    <div class="bg-light text-center p-3 border-bottom d-flex align-items-center justify-content-center" style="height: 180px;">
                        <img src="{{ $srcImagem }}"
                            alt="{{ $item->nome }}" 
                            class="img-fluid mh-100 rounded" 
                            style="object-fit: contain;">
                    </div>

                    <!-- Detalhes da Nota -->
                    <div class="card-body d-flex flex-column text-center">
                        <h5 class="card-title fw-bold mb-2 text-dark">{{ $item->nome }}</h5>
                        <p class="card-text text-muted small flex-grow-1" style="white-space: pre-line;">
                            {{ $item->descricao ?? 'Sem descrição informada.' }}
                        </p>
                    </div>

                    <!-- Ações de Gerenciamento do CRUD -->
                    <div class="card-footer bg-transparent border-top d-flex justify-content-between gap-2 py-2">
                        <a class="btn btn-sm btn-outline-warning w-50" title="Editar" href="{{ route('notas.edit', $item->id) }}">
                            Editar
                        </a>
                        
                        <form action="{{ route('notas.destroy', $item->id) }}" method="post" class="w-50 m-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger w-100" title="Excluir"
                                onclick="return confirm('Deseja realmente excluir esta nota olfativa?')">
                                Deletar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Mensagem de lista vazia -->
    @if($dados->isEmpty())
        <div class="alert alert-info mt-4">
            Nenhuma nota olfativa cadastrada no momento.
        </div>
    @endif

@stop