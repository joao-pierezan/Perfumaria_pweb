<div class="mb-3">
    <label>Ficha Técnica (Notas Olfativas)</label>
    <select name="ficha_tecnica_id" class="form-control" required>
        <option value="">Selecione a Ficha Técnica...</option>
        @foreach($fichas as $ficha)
            <option value="{{ $ficha->id }}" {{ isset($data) && $data->ficha_tecnica_id == $ficha->id ? 'selected' : '' }}>
                Topo: {{ $ficha->notas_topo }} | Coração: {{ $ficha->notas_coracao }}
            </option>
        @endforeach
    </select>
</div>