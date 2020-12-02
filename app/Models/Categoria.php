<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    public function entradas(){
        return $this->belongsToMany(\App\Models\Entrada::class, 'categorias_entradas', 'category_id', 'entry_id')->where('entradas.status', true);
    }
}
