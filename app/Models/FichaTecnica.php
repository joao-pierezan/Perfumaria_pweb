<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FichaTecnica extends Model
{
    use HasFactory;
    protected $table = 'ficha_tecnicas';
    protected $fillable = ['notas_topo', 'notas_coracao', 'notas_base'];

    public function perfume()
    {
        return $this->hasOne(Perfume::class);
    }

}

