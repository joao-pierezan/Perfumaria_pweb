<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Avaliacao extends Model
{
    use HasFactory;
    protected $table = 'avaliacoes';
    protected $fillable = ['perfume', 'nota', 'texto', 'autor', 'longevidade', 'venda_id'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'autor'); 
    }

    public function perfumeRelacionado()
    {
        return $this->belongsTo(Perfume::class, 'perfume');
    }

    public function venda()
    {
        return $this->belongsTo(Venda::class, 'venda_id');
    }
}