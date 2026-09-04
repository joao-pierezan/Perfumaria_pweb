@extends('main')
@section('titulo', 'Listagem de Avaliacoes')
@section('conteudo')
    <div class="row">
        <h3>Listagem de Resenhas</h3>
        <form action="{{ route('avaliacoes.search') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-2">
                    <label for="nome">Tipo</label>
                    <select name="tipo" class="form-select">
                        <option value="perfume">Perfume</option>
                        <option value="nota">Nota</option>
                        <option value="texto">Resenha</option>
                    </select>
                </div>
                <div class="col-5">
                    <label for="valor">Valor</label>
                    <input type="text" name="valor" placeholder="Pesquisar..." class="form-control">
                </div>
                <div class="col-5 align-self-end">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    <a href="{{ url('avaliacoes/create') }}" class="btn btn-success">Novo</a>
                </div>
            </div>
        </form>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            @foreach ($dados as $item)
                <!-- Bloco individual da Resenha -->
                <div class="card mb-4 border-secondary">
                    <div class="card-header d-flex justify-content-between align-items-center bg-light">
                        <div>
                            <h5 class="m-0 d-inline"><strong>{{ $item->perfume }}</strong></h5>
                        </div>
                        <span class="fs-6"><strong>Nota:</strong> {{ $item->nota }}</span>
                    </div>
                    
                    <div class="card-body">
                        <p class="card-text fs-5" style="white-space: pre-line;">{{ $item->texto }}</p>
                    </div>
                    
                    <div class="card-footer text-muted d-flex justify-content-end gap-2 align-items-center">
                        <small class="me-auto">
                            <strong>Autor:</strong> {{ $item->usuario->nome ?? 'Anônimo' }} | 
                            ID da Avaliação: {{ $item->id }}
                        </small>
                        
                        <!-- Botões de Ação -->
                        <a class="btn btn-sm btn-outline-warning" title="Editar" href="{{ route('avaliacoes.edit', $item->id) }}">Editar</a>
                        
                        <form action="{{ route('avaliacoes.destroy', $item->id) }}" method="post" class="m-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Excluir"
                                onclick="return confirm('Deseja realmente excluir esta resenha?')">Deletar</button>
                        </form>
                    </div>
                </div>
            @endforeach

            <!-- Mensagem caso não tenha nenhuma resenha -->
            @if($dados->isEmpty())
                <div class="alert alert-info mt-3">
                    Nenhuma resenha encontrada.
                </div>
            @endif
        </div>
    </div>
@stop