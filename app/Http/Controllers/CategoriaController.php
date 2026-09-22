<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Muestra el listado de categorias.
     * Acompanamos cada categoria con la cantidad de productos que contiene.
     */
    public function index()
    {
        $categorias = Categoria::withCount('productos')->get();

        return view('categorias', compact('categorias'));
    }

    /**
     * Guarda una nueva categoria en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        Categoria::create([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('categorias.index')
            ->with('exito_Categoria', 'La categoría ha sido creada.');
    }

    /**
     * Actualiza el nombre de una categoria existente.
     */
    public function update(Request $request, Categoria $categoria)
    {
        $categoria->update([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('categorias.index')
            ->with('exito_Categoria', 'La categoría ha sido actualizada.');
    }

    /**
     * Elimina una categoria de la base de datos.
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route('categorias.index')
            ->with('exito_Categoria', 'La categoría ha sido eliminada.');
    }
}
