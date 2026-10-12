<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perfume extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nome',
        'marca',
        'preco',
        'familia_olfativa',
        'volume',
        'imagem',
    ];

    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class, 'perfume');
    }

    public function notas()
    {
        return $this->belongsToMany(Notas::class, 'perfume_nota', 'perfume_id', 'nota_id')
                    ->withPivot('tipo')
                    ->withTimestamps();
    }

    public function notasTopo()
    {
        return $this->belongsToMany(Notas::class, 'perfume_nota', 'perfume_id', 'nota_id')
                    ->wherePivot('tipo', 'topo')
                    ->withPivot('tipo');
    }

    public function notasCoracao()
    {
        return $this->belongsToMany(Notas::class, 'perfume_nota', 'perfume_id', 'nota_id')
                    ->wherePivot('tipo', 'coracao')
                    ->withPivot('tipo');
    }

    public function notasFundo()
    {
        return $this->belongsToMany(Notas::class, 'perfume_nota', 'perfume_id', 'nota_id')
                    ->wherePivot('tipo', 'fundo')
                    ->withPivot('tipo');
    }
}
