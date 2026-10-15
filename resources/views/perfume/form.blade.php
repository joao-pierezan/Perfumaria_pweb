@extends('main')
@section('titulo', 'Formulário de Perfumes')
@section('conteudo')
    <div class="row">
        @php
            if (!empty($data->id)) {
                $action = route('perfume.update', $data->id);
            } else {
                $action = route('perfume.store');
            }
        @endphp

        <h4 class="mb-3">{{ !empty($data->id) ? 'Editar Perfume' : 'Cadastrar Perfume' }}</h4>
        
        <form action="{{ $action }}" method="post" enctype="multipart/form-data">
            @csrf
            @if (!empty($data->id))
                @method('PUT')
            @endif

            <input type="hidden" name="id" value="{{ old('id', $data->id ?? '') }}">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nome" class="form-label fw-bold">Nome do Perfume</label>
                    <input type="text" name="nome" class="form-control" value="{{ old('nome', $data->nome ?? '') }}" placeholder="Ex: Sauvage, Bleu, Malbec..." required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="marca" class="form-label fw-bold">Marca</label>
                    <input type="text" name="marca" class="form-control" value="{{ old('marca', $data->marca ?? '') }}" placeholder="Ex: Dior, Chanel, O Boticário..." required>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="preco" class="form-label fw-bold">Preço (R$)</label>
                    <input type="number" step="0.01" name="preco" class="form-control" value="{{ old('preco', $data->preco ?? '') }}" placeholder="0.00" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="familia_olfativa" class="form-label fw-bold">Família Olfativa</label>
                    <input type="text" name="familia_olfativa" class="form-control" value="{{ old('familia_olfativa', $data->familia_olfativa ?? '') }}" placeholder="Ex: Amadeirado, Cítrico, Oriental..." required>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="volume" class="form-label fw-bold">Volume</label>
                    <input type="text" name="volume" class="form-control" value="{{ old('volume', $data->volume ?? '') }}" placeholder="Ex: 50ml, 100ml..." required>
                </div>

                <div class="col-12 mb-3">
                    <label for="imagem" class="form-label fw-bold">Imagem do Perfume</label>
                    <div class="d-flex align-items-center gap-3">
                        @if(!empty($data->imagem))
                            <img src="/storage/{{ $data->imagem }}" width="80" height="80" class="rounded border p-1" style="object-fit: contain;" alt="Prévia" />
                        @endif
                        <div class="flex-grow-1">
                            <input type="file" name="imagem" class="form-control" accept="image/*">
                            <small class="text-muted">Extensões permitidas: JPG, PNG, WEBP</small>
                        </div>
                    </div>
                </div>

                <!-- Seção das Notas Olfativas nas 3 Linhas -->
                <div class="col-12 mt-3">
                    <h5 class="fw-bold border-bottom pb-2">Pirâmide Olfativa (Notas do Perfume)</h5>
                    <p class="text-muted small">Marque as notas que compõem este perfume em cada uma das etapas:</p>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold text-primary">Notas de Topo (Saída)</label>
                    <div class="border rounded p-2 bg-light" style="max-height: 200px; overflow-y: auto;">
                        @forelse ($notas as $nota)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="notas_topo[]" value="{{ $nota->id }}" id="topo_{{ $nota->id }}"
                                    {{ in_array($nota->id, old('notas_topo', $notasTopoIds ?? [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="topo_{{ $nota->id }}">
                                    {{ $nota->nome }}
                                </label>
                            </div>
                        @empty
                            <p class="text-muted small mb-0">Nenhuma nota cadastrada.</p>
                        @endforelse
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold text-success">Notas de Coração (Corpo)</label>
                    <div class="border rounded p-2 bg-light" style="max-height: 200px; overflow-y: auto;">
                        @forelse ($notas as $nota)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="notas_coracao[]" value="{{ $nota->id }}" id="coracao_{{ $nota->id }}"
                                    {{ in_array($nota->id, old('notas_coracao', $notasCoracaoIds ?? [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="coracao_{{ $nota->id }}">
                                    {{ $nota->nome }}
                                </label>
                            </div>
                        @empty
                            <p class="text-muted small mb-0">Nenhuma nota cadastrada.</p>
                        @endforelse
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-bold text-warning text-dark">Notas de Base (Fundo)</label>
                    <div class="border rounded p-2 bg-light" style="max-height: 200px; overflow-y: auto;">
                        @forelse ($notas as $nota)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="notas_fundo[]" value="{{ $nota->id }}" id="fundo_{{ $nota->id }}"
                                    {{ in_array($nota->id, old('notas_fundo', $notasFundoIds ?? [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="fundo_{{ $nota->id }}">
                                    {{ $nota->nome }}
                                </label>
                            </div>
                        @empty
                            <p class="text-muted small mb-0">Nenhuma nota cadastrada.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="{{ url('perfume')}}" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    </div>
@stop