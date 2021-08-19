<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TareaCategoria extends Model
{
    use HasFactory;

    protected $table = 'tarea_categorias';


    public function tarea()
    {
        return $this->belongsTo(Tarea::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
