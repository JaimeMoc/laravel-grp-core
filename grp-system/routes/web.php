<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

// Autenticación Tradicional
Route::post('/api/login', [AuthController::class, 'login']);
Route::post('/api/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Autenticación Microsoft SSO
Route::get('/auth/microsoft', [AuthController::class, 'redirectToMicrosoft']);
Route::get('/auth/microsoft/callback', [AuthController::class, 'handleMicrosoftCallback']);

// Perfil de Usuario
Route::middleware(['auth:sanctum'])->get('/api/profile', function (Request $request){
    return [
        'user' => $request->user(),
        'role' => $request->user()->role->name,
    ];
});

// Administrador -> Acceso completo
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware(['auth:sanctum', 'role:admin']);
Route::get('/admin/users', [AdminController::class, 'manageUsers'])->middleware(['auth:sanctum', 'role:admin']);
Route::get('/admin/settings', [AdminController::class, 'settings'])->middleware(['auth:sanctum', 'role:admin']);

// Gestor/funcionario -> Modulos especificos
Route::get('/gestor/modules', [GestorController::class, 'modules'])->middleware(['auth:sanctum', 'role:gestor']);
Route::get('/gestor/resources', [GestorController::class, 'resources'])->middleware(['auth:sanctum', 'role:gestor']);
Route::get('/gestor/operations', [GestorController::class, 'operations'])->middleware(['auth:sanctum', 'role:gestor']);

// Auditor/Supervisor -> reportes y trazabilidad
Route::get('/auditor/reports', [AuditorController::class, 'reports'])->middleware(['auth:sanctum', 'role:auditor']);
Route::get('/auditor/traceability', [AuditorController::class, 'traceability'])->middleware(['auth:sanctum', 'role:auditor']);
Route::get('/auditor/validate', [AuditorController::class, 'validateData'])->middleware(['auth:sanctum', 'role:auditor']);

// Invitado -> Información publica.
Route::get('/public/info', [PublicController::class, 'info'])->middleware(['auth:sanctum', 'role:invitado']);
Route::get('/public/news', [PublicController::class, 'news'])->middleware(['auth:sanctum', 'role:invitado']);
Route::get('/public/documents', [PublicController::class, 'documents'])->middleware(['auth:sanctum', 'role:invitado']);
