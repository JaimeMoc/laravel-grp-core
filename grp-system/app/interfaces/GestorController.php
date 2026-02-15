<?php

namespace App\Interfaces\Http\Controllers;

class GestorController extends Controller
{
    public function modules(){
        return response()->json(['message' => 'Módulos del gestor']);
    }

    public function resources(){
        return response()->json([['message' => 'Gestión de recursos']]);
    }

    public function operations(){
        return response()->json(['message' => 'Operaciones del gestor']);
    }
}
