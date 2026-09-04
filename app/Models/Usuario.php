<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Model
{
    use Hasfactory;


     protected $table = 'usuarios';
    protected $fillable = [
        'nome',
        'cpf',
        'email',
        'telefone'
    ];
}