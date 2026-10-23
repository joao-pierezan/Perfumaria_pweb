@extends('main')
@section('titulo', 'Formulário de Avaliações')
@section('conteudo')
    <div class="row">
        @php
            if (!empty($data->id)) {
                $action = route('avaliacoes.update', $data->id);
            } else {
                $action = route('avaliacoes.store');
            }
        @endphp

        <h4>Formulário Avaliação</h4>
        <form action="{{ $action }}" method="post">
            @csrf
            @if (!empty($data->id))
                @method('PUT')
            @endif

            <input type="hidden" name="id" value="{{ old('id', $data->id ?? '') }}">
            
            <!-- Venda vinculada (Relacionamento 1:1) -->
            <div class="col-12 mb-3">
                <label for="venda_id" class="fw-semibold">Venda Associada (Relacionamento 1:1)</label>
                <select name="venda_id" id="venda_id" class="form-select @error('venda_id') is-invalid @enderror">
                    <option value="">Sem venda vinculada (Avaliação direta)</option>
                    @foreach ($vendas ?? [] as $vendaItem)
                        @php
                            $vendaVal = $vendaItem->id;
                            $isSelectedVenda = (
                                old('venda_id', $data->venda_id ?? request('venda_id')) == $vendaVal
                            );
                        @endphp
                        <option value="{{ $vendaVal }}" {{ $isSelectedVenda ? 'selected' : '' }}>
                            Venda #{{ $vendaItem->id }} &bull; {{ $vendaItem->perfume->nome ?? 'Perfume' }} (Comprador: {{ $vendaItem->usuario->nome ?? 'Usuário' }}) - R$ {{ number_format($vendaItem->valor_total, 2, ',', '.') }}
                        </option>
                    @endforeach
                </select>
                @error('venda_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Cada venda só pode possuir no máximo uma avaliação no banco de dados.</small>
            </div>

            <!-- CORRIGIDO: name="autor" para coincidir com o Model e Validação -->
            <div class="col-6 mb-3">
                <label for="autor">Autor / Usuário</label>
                <select name="autor" class="form-select" required>
                    <option value="">Selecione um usuário...</option>
                    @foreach ($usuarios ?? [] as $item)
                        @php
                            $userValue = $item->id;
                            $isSelected = (
                                old('autor', $data->autor ?? '') == $userValue
                            );
                        @endphp
                        <option value="{{ $userValue }}" {{ $isSelected ? 'selected' : '' }}>
                            {{ $item->nome ?? $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- CORRIGIDO: name="perfume" para coincidir com o Model e Validação -->
            <div class="col-6 mb-3">
                <label for="perfume">Perfume</label>
                <select name="perfume" class="form-select" required>
                    <option value="">Selecione um perfume...</option>
                        @foreach ($perfumes as $item)
                            @php
                                $nomeCompleto = trim(($item->marca ?? '') . ' ' . ($item->nome ?? $item->name));
                                $perfumeValue = $item->id; 
                                
                                // Verifica se deve vir selecionado (seja por edição, old input, ou parâmetro na URL)
                                $isSelectedPerfume = (
                                    old('perfume', $data->perfume ?? request('perfume_id')) == $perfumeValue
                                );
                            @endphp
                            <option value="{{ $perfumeValue }}" {{ $isSelectedPerfume ? 'selected' : '' }}>
                                {{ $nomeCompleto }}
                            </option>
                        @endforeach
                </select>
            </div>

            <div class="col-6 mb-3">
                <label for="nota">Nota de 0 a 10</label>
                <input type="number" step="0.01" min="0" max="10" name="nota" class="form-control" value="{{ old('nota', $data->nota ?? '') }}" required>
            </div>

            <div class="col-6 mb-3">
                <label for="longevidade">Longevidade (Fixação do Perfume)</label>
                <select name="longevidade" id="longevidade" class="form-select" required>
                    <option value="curto" {{ old('longevidade', $data->longevidade ?? 'medio') == 'curto' ? 'selected' : '' }}>
                        Curto (1 a 3 horas)
                    </option>
                    <option value="medio" {{ old('longevidade', $data->longevidade ?? 'medio') == 'medio' ? 'selected' : '' }}>
                        Médio (4 a 7 horas)
                    </option>
                    <option value="longo" {{ old('longevidade', $data->longevidade ?? 'medio') == 'longo' ? 'selected' : '' }}>
                        Longo (8+ horas)
                    </option>
                </select>
            </div>

            <div class="col-12 mb-3">
                <label for="texto">Resenha</label>
                <textarea name="texto" class="form-control" rows="4" required>{{ old('texto', $data->texto ?? '') }}</textarea>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-success">Salvar</button>
                
                @php
                    $urlVoltar = !empty($data->perfume) ? url('perfume/' . $data->perfume) : url('avaliacoes');
                @endphp
                <a href="{{ $urlVoltar }}" class="btn btn-primary">Voltar</a>
            </div>
        </form>
    </div>
@stop