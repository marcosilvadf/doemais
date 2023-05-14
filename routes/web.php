<?php

use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\ObjetoController;
use App\Http\Controllers\OngController;

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

//Route::get('/', [InicioController::class, 'index']);
Route::middleware(['logado'])->group(function () {
    Route::get('/', [InicioController::class, 'index'])->name('inicio');
    Route::get('/log/perfil', [UsuarioController::class, 'perfil'])->name('log.perfil');
    Route::get('/log/editar/{id}', [UsuarioController::class, 'edtUser'])->name('log.edtUser');
    Route::get('/log/deletar', [UsuarioController::class, 'deletar'])->name('log.deletar');
    Route::post('/log/editar', [UsuarioController::class, 'update'])->name('log.editar');
    Route::get('/log/deslogar', [UsuarioController::class, 'deslogar'])->name('log.deslogar');
});
Route::get('/log/cadastrar/{ong}', [UsuarioController::class, 'create'])->name('log.create');
Route::post('/log/cadastrar', [UsuarioController::class, 'store'])->name('log.cadastrar');
Route::get('/log/login', [UsuarioController::class, 'login'])->name('log.login');
Route::get('/log/recovery', [UsuarioController::class, 'recuperarSenhaForm'])->name('log.recovery');
Route::post('/log/recovery', [UsuarioController::class, 'recuperarSenha'])->name('log.recovery');
Route::post('/log/login', [UsuarioController::class, 'createLogin'])->name('log.login');

Route::get('/categoria', [CategoriaController::class, 'create']);
Route::post('/categoria', [CategoriaController::class, 'store'])->name('cadastrar.categoria');

Route::get('/categoria', [CategoriaController::class, 'create']);
Route::post('/categoria', [CategoriaController::class, 'store'])->name('cadastrar.categoria');

Route::get('/objeto', [ObjetoController::class, 'create']);
Route::post('/objeto', [ObjetoController::class, 'store'])->name('cadastrar.objeto');

Route::get('/Ong/{id}', [OngController::class, 'show'])->name('ong.show');
Route::get('/Ong/doar/{id}', [OngController::class, 'formDoar'])->name('ong.form');
Route::post('/Ong/doar', [OngController::class, 'receberForm'])->name('ong.form');
Route::get('/Ong/enviado/{id}', [OngController::class, 'enviado'])->name('ong.enviado');
Route::get('/Ong/recebido/{id}', [OngController::class, 'recebido'])->name('ong.recebido');
Route::get('/Ong/deletar/{id}', [OngController::class, 'deletar'])->name('ong.deletar');

Route::get('/admin', [UsuarioController::class, 'listAll'])->name('admin');