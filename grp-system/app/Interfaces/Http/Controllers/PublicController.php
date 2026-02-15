<?php

namespace App\Interfaces\Http\Controllers;

class PublicController extends Controller
{
    public function info(){
        return response()->json(['message' => 'Información pública']);
    }

    public function news(){
        return response()->json(['message' => 'Noticias publicas']);
    }

    public function documents(){
        return response()->json(['message' => 'Documentos públicos']);
    }
}
