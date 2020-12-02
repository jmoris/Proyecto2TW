<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    use HasFactory;

    public function user(){
        return $this->hasOne(\App\Models\User::class, 'id', 'author_id');
    }

    public function categorias(){
        return $this->belongsToMany(\App\Models\Categoria::class, 'categorias_entradas', 'entry_id', 'category_id');
    }
}
