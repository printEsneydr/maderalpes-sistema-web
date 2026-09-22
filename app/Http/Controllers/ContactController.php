<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Recibe los mensajes del formulario de contacto de la página pública.
     * Valida los datos y confirma al visitante que su mensaje fue enviado.
     */
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        return redirect()->route('contacto')
            ->with('contacto_exitoso', '¡Gracias por escribirnos! Pronto estaremos en contacto contigo.');
    }
}
