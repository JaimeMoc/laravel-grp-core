<?php

namespace App\Interfaces;

class AuditorController extends Controller
{
    public function reports(){
        return response()->json(['message' => 'Reportes del auditor']);
    }

    public function traceability(){
        return response()->json(['message' => 'Trazabilidad de procesos']);
    }

    public function validateData(){
        return request()->json(['message' => 'Validación de datos']);
    }
}
