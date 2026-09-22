<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    // Campos que se pueden asignar desde los formularios.
    protected $fillable = [
        'nombre',
    ];

    // Relaciona cada categoria con sus productos usando su nombre.
    public function productos()
    {
        return $this->hasMany(Producto::class, 'categoria', 'nombre');
    }
}
