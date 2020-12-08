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

Auth::routes(['register' => false]);

Route::get('/', [App\Http\Controllers\WebController::class, 'index']);
Route::get('contacto', [App\Http\Controllers\WebController::class, 'contacto']);
Route::post('contacto', [App\Http\Controllers\WebController::class, 'enviarContacto']);
Route::get('blog', [App\Http\Controllers\WebController::class, 'blog']);
Route::get('blog/{id}', [App\Http\Controllers\WebController::class, 'blogDetail']);
Route::post('blog/{id}/puntuar', [App\Http\Controllers\WebController::class, 'blogRating']);

Route::prefix('gestion')->middleware(['auth', 'checkuser'])->group(function () {
    Route::get('/home', [App\Http\Controllers\GestionController::class, 'index']);
    Route::middleware('role:superadmin')->group(function () {
        Route::get('/configuracion', [App\Http\Controllers\GestionController::class, 'vistaConfiguraciones']);
        Route::post('/configuracion/blog', [App\Http\Controllers\GestionController::class, 'saveConfigBlog']);
        Route::post('/configuracion/categoria', [App\Http\Controllers\GestionController::class, 'addCategoria']);
        Route::post('/configuracion/categoria/{id}', [App\Http\Controllers\GestionController::class, 'deleteCategoria']);
    });
    Route::middleware('role:superadmin|admin')->group(function () {
        Route::get('/usuarios', [App\Http\Controllers\GestionController::class, 'vistaUsuarios']);
        Route::get('/usuarios/{id}', [App\Http\Controllers\GestionController::class, 'getUsuario']);
        Route::post('/usuarios', [App\Http\Controllers\GestionController::class, 'addUsuario']);
        Route::put('/usuarios/{id}', [App\Http\Controllers\GestionController::class, 'updateUsuario']);
        Route::post('/usuarios/editar/{id}', [App\Http\Controllers\GestionController::class, 'updateUsuario']);
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