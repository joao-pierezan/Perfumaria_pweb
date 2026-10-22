@extends('main')
@section('titulo', isset($a->id) ? 'Editar Venda' : 'Nova Venda')

@section('conteudo')
    <h1 class="mb-4">{{ isset($a->id) ? 'Editar Venda' : 'Nova Venda' }}</h1>

    <form action="{{ isset($a->id) ? route('vendas.update', $a->id) : route('vendas.store') }}" method="POST">
        @csrf
        @if(isset($a->id))
            @method('PUT')
        @endif

        {{-- Perfumes Selecionados --}}
        <div class="mb-3">
            <label class="form-label">Perfume</label>
            <div id="container-perfumes">
                <div class="d-flex gap-2 mb-2 item-perfume">
                    <select name="perfumes[]" class="form-control select-perfume" required>
                        <option value="" data-preco="0">Selecione um perfume</option>
                        @foreach($b as $perfume)
                            @php
                                $selectedId = old('perfumes.0', isset($a->perfume_id) ? $a->perfume_id : request('perfume_id'));
                            @endphp
                            <option value="{{ $perfume->id }}" data-preco="{{ $perfume->preco }}" {{ $selectedId == $perfume->id ? 'selected' : '' }}>
                                {{ $perfume->nome }} - R$ {{ number_format($perfume->preco, 2, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="button" id="btn-adicionar-perfume" class="btn btn-outline-primary btn-sm mt-1">
                + Adicionar mais um perfume
            </button>
        </div>

        {{-- Usuário Comprador --}}
        <div class="mb-3">
            <label for="usuario_id" class="form-label">Usuário</label>
            <select name="usuario_id" id="usuario_id" class="form-control" required>
                <option value="">Selecione um usuário</option>
                @foreach($c as $usuario)
                    <option value="{{ $usuario->id }}" {{ (old('usuario_id', $a->usuario_id ?? '') == $usuario->id) ? 'selected' : '' }}>
                        {{ $usuario->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Valor Total Calculado Automaticamente --}}
        <div class="col-6 mb-3">
            <label for="valor_total">Valor Total (R$)</label>
            <input type="number" step="0.01" name="valor_total" id="valor_total" class="form-control" 
                   value="{{ old('valor_total', $a->valor_total ?? '0.00') }}" readonly required>
            <small class="text-muted">Calculado automaticamente com base nos perfumes selecionados.</small>
        </div>

        <button type="submit" class="btn btn-success">{{ isset($a->id) ? 'Atualizar' : 'Salvar' }}</button>
        <a href="{{ route('vendas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>

    {{-- Template Oculto para Adicionar Novos Perfumes Dinamicamente --}}
    <template id="template-perfume">
        <div class="d-flex gap-2 mb-2 item-perfume">
            <select name="perfumes[]" class="form-control select-perfume" required>
                <option value="" data-preco="0">Selecione um perfume</option>
                @foreach($b as $perfume)
                    <option value="{{ $perfume->id }}" data-preco="{{ $perfume->preco }}">
                        {{ $perfume->nome }} - R$ {{ number_format($perfume->preco, 2, ',', '.') }}
                    </option>
                @endforeach
            </select>
            <button type="button" class="btn btn-outline-danger btn-remover" title="Remover este perfume">
                &times;
            </button>
        </div>
    </template>

    <script>
        function calcularTotal() {
            let total = 0;
            document.querySelectorAll('.select-perfume').forEach(function(select) {
                const selectedOption = select.options[select.selectedIndex];
                if (selectedOption && selectedOption.dataset.preco) {
                    total += parseFloat(selectedOption.dataset.preco) || 0;
                }
            });
            document.getElementById('valor_total').value = total.toFixed(2);
        }

        // Adicionar novo select de perfume
        document.getElementById('btn-adicionar-perfume').addEventListener('click', function() {
            const template = document.getElementById('template-perfume').content.cloneNode(true);
            const novoItem = template.querySelector('.item-perfume');

            // Evento de alteração no novo select
            novoItem.querySelector('.select-perfume').addEventListener('change', calcularTotal);

            // Evento do botão remover
            novoItem.querySelector('.btn-remover').addEventListener('click', function() {
                novoItem.remove();
                calcularTotal();
            });

            document.getElementById('container-perfumes').appendChild(novoItem);
        });

        // Escutar alterações nos selects de perfume
        document.addEventListener('change', function(e) {
            if (e.target && e.target.classList.contains('select-perfume')) {
                calcularTotal();
            }
        });

        // Cálculo inicial ao carregar a página
        document.addEventListener('DOMContentLoaded', calcularTotal);
    </script>
@endsection