<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notas extends Model
{
    /** @use HasFactory<\Database\Factories\NotasFactory> */
    use HasFactory;
     protected $fillable = [
        'imagem',
        'nome',
        'descricao'
    ];

    public function perfumes()
    {
        return $this->belongsToMany(Perfume::class, 'perfume_nota', 'nota_id', 'perfume_id')
                    ->withPivot('tipo')
                    ->withTimestamps();
    }
}
