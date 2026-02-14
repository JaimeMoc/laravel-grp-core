<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        return response()->json(['message' => 'Panel de administrador']);
    }

    public function manager(){
        return response()->json(['message' => 'Gestión de usuarios']);
    }

    public function settings(){
        return response()->json(['message' => 'Configuración del sistema']);
    }
}
