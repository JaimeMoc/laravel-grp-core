<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::post('/api/login', [AuthController::class, 'login']);
Route::post('/api/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->get('/api/profile', function (Request $request){
    return [
        'user' => $request->user(),
        'role' => $request->user()->role->name,
    ];
});

// Administrador -> Acceso completo
Route::get('/admin/dashboard', function () {
    return 'Panel de administrador';
})->middleware(['auth:sanctum', 'role:admin']);

// Gestor/funcionario -> módulos especificos
Route::get('/gestor/modules', function () {
    return 'Módulos del gestor';
})->middleware(['auth:sanctum', 'role:gestor']);

// Auditor/Supervisor -> reportes y trazalabilidad
Route::get('/auditor/reports', function () {
    return 'Reportes del auditor';
})->middleware(['auth:sanctum', 'role:auditor']);

// Invitado -> información pública
Route::get('/public/info', function () {
    return 'Información pública';
})->middleware(['auth:sanctum', 'role:invitado']);
