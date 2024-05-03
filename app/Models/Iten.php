<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iten extends Model
{
    use HasFactory;

      protected $fillable = [
        'codigo',
        'nome',
        'categoria',
        'descricao',
        'preco',
        'qtdunitaria',
        'user_id',
        'empresa_id',
    ];

}
