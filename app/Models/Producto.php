<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // Campos que se pueden asignar desde los formularios.
    protected $fillable = [
        'nombre',
        'categoria',
        'precio',
        'imagen',
        'descripcion',
    ];
}
