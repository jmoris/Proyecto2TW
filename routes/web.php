<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\WebController::class, 'index']);
Route::get('contacto', [App\Http\Controllers\WebController::class, 'contacto']);
Route::get('blog', [App\Http\Controllers\WebController::class, 'blog']);
Route::get('blog/{id}', [App\Http\Controllers\WebController::class, 'blogDetail']);

Route::prefix('gestion')->middleware(['auth', 'checkuser'])->group(function () {
    Route::get('/home', [App\Http\Controllers\GestionController::class, 'index']);
    Route::middleware('role:superadmin')->group(function () {
        Route::get('/configuracion', [App\Http\Controllers\GestionController::class, 'vistaConfiguraciones']);
    });
    Route::middleware('role:superadmin|admin')->group(function () {
        Route::get('/usuarios', [App\Http\Controllers\GestionController::class, 'vistaUsuarios']);
        Route::get('/usuarios/{id}', [App\Http\Controllers\GestionController::class, 'getUsuario']);
        Route::post('/usuarios', [App\Http\Controllers\GestionController::class, 'addUsuario']);
        Route::put('/usuarios/{id}', [App\Http\Controllers\GestionController::class, 'updateUsuario']);
        Route::post('/usuarios/habilitar', [App\Http\Controllers\GestionController::class, 'deleteUsuario']);
    });

    Route::middleware('role:superadmin|admin|escritor')->group(function () {
        Route::get('/publicaciones', [App\Http\Controllers\GestionController::class, 'vistaPublicaciones']);
        Route::post('/publicaciones', [App\Http\Controllers\GestionController::class, 'addPublicacion']);
        Route::post('/publicaciones/{id}', [App\Http\Controllers\GestionController::class, 'updatePublicacion']);
        Route::get('/publicaciones/{id}', [App\Http\Controllers\GestionController::class, 'getPublicacion']);
        Route::get('/publicaciones/habilitar/{id}', [App\Http\Controllers\GestionController::class, 'deletePublicacion']);
    });
});