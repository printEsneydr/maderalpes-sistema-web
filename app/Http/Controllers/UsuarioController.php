<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Muestra el listado de usuarios del sistema.
     */
    public function index()
    {
        $usuarios = User::all();

        return view('usuarios', compact('usuarios'));
    }

    /**
     * Guarda un nuevo usuario en el sistema.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return redirect()->route('usuarios.index')
            ->with('exito_usuario', 'Usuario creado correctamente.');
    }

    /**
     * Elimina un usuario del sistema.
     * No permite que la persona conectada se elimine a sí misma.
     */
    public function destroy(User $usuario)
    {
        if ($usuario->id === auth()->id()) {
            return redirect()->route('usuarios.index')
                ->withErrors('No puedes eliminar el usuario con el que iniciaste sesión.');
        }

        $usuario->delete();

        return redirect()->route('usuarios.index')
            ->with('exito_usuario', 'Usuario eliminado correctamente.');
    }
}
