<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perfume extends Model
{
    use Hasfactory;
    
    protected $fillable = [
        'nome',
        'marca',
        'preco',
        'familia_olfativa',
        'volume'
    ];

    public function fichaTecnica()
    {
        return $this->belongsTo(FichaTecnica::class);
    }
}
