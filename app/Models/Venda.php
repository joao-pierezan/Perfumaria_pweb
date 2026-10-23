<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    /** @use HasFactory<\Database\Factories\VendasFactory> */
    use HasFactory;

    protected $fillable = [
        'perfume_id',
        'usuario_id',
        'valor_total'
    ];
    public function perfume()
    {
        return $this->belongsTo(Perfume::class, 'perfume_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function avaliacao()
    {
        return $this->hasOne(Avaliacao::class, 'venda_id');
    }
}
