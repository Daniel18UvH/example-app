<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client; // Importamos el modelo de Clientes
use App\Models\User;   // Importamos el modelo de Usuarios

class DashboardController extends Controller
{
    public function index()
    {
        // Obtenemos los datos de la base de datos
        $totalClients = Client::count();
        $recentClients = Client::latest()->take(5)->get();
        $activeProjects = Client::where('status', 'Activo')->count();

        // Retornamos la vista pasando las variables
        return view('dashboard', compact('totalClients', 'recentClients', 'activeProjects'));
    }
}
