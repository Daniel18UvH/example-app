<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    // Muestra la pantalla del formulario
    public function create()
    {
        return view('clients.create');
    }

    // Recibe los datos del formulario y los guarda
    public function store(Request $request)
    {
        // 1. Validar que los datos sean correctos
        $validated = $request->validate([
            'name' => 'required|min:3',
            'company' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
        ]);

        // 2. Crear el cliente asociado al usuario actual
        // (El 'user_id' se llena automático con Auth::id())
        $request->user()->clients()->create($validated);

        // 3. Regresar al Dashboard con un mensaje de éxito
        return redirect()->route('dashboard');
    }
}
