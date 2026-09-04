<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Avaliacao extends Model
{
    use HasFactory;
    protected $table = 'avaliacoes';
    protected $fillable = ['perfume', 'nota', 'texto', 'autor'];

    public function usuario()
        {
            return $this->belongsTo(Usuario::class, 'autor'); 
        }
}