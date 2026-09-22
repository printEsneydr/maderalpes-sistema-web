<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Muestra el listado de productos registrados.
     */
    public function index()
    {
        $productos = Producto::all();

        return view('producto', compact('productos'));
    }

    /**
     * Crea un nuevo producto con los datos enviados.
     * Si el formulario incluye una imagen, la guarda en la carpeta publica de archivos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|max:5120',
        ]);

        // Ruta de la imagen, si no se sube ninguna queda vacia.
        $imagenPath = null;

        if ($request->hasFile('imagen')) {
            // Se guarda en la carpeta publica para poder mostrarla en el catalogo.
            $imagenPath = Storage::disk('public')->put('productos', $request->file('imagen'));
        }

        // Guarda el producto en la base de datos.
        Producto::create([
            'nombre' => $request->nombre,
            'categoria' => $request->categoria,
            'precio' => $request->precio,
            'descripcion' => $request->descripcion,
            'imagen' => $imagenPath,
        ]);

        // Regresa al listado con un mensaje de confirmacion.
        return redirect()->route('productos.index')
            ->with('success', 'Producto creado correctamente.');
    }

    /**
     * Actualiza la informacion de un producto ya existente.
     * Si se sube una imagen nueva, reemplaza la anterior.
     */
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|max:5120',
        ]);

        // Conserva la imagen actual del producto por si no se sube una nueva.
        $imagenPath = $producto->imagen;

        if ($request->hasFile('imagen')) {
            // Se guarda en la carpeta publica para mostrarla en el catalogo.
            $imagenPath = Storage::disk('public')->put('productos', $request->file('imagen'));
        }

        $producto->update([
            'nombre' => $request->input('nombre'),
            'categoria' => $request->input(('categoria')),
            'precio' => $request->input('precio'),
            'descripcion' => $request->input('descripcion'),
            'imagen' => $imagenPath,
        ]);

        // Regresa al listado con un mensaje de confirmacion.
        return redirect()->route('productos.index')
            ->with('edit', 'Producto actualizado correctamente');
    }

    /**
     * Elimina un producto de la base de datos.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('productos.index')
            ->with('delete', 'Producto eliminado correctamente');
    }
}
