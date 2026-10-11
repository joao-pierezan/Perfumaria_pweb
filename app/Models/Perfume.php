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
        'ficha_tecnica_id',
    ];

    public function fichaTecnica()
    {
        return $this->belongsTo(FichaTecnica::class);
    }

    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class, 'perfume');
    }
}
