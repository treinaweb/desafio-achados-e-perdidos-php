<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BuscarLocais;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\ObjetoController;
use App\Http\Controllers\DefinirDonoObjeto;
use App\Http\Controllers\ImagemLocalUpload;
use App\Http\Controllers\ImagemObjetoUpload;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListarObjetosLocal;

Route::get('/', IndexController::class);

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::post('refresh', [AuthController::class, 'refresh'])->name('auth.refresh');
});

Route::post('/locais', [LocalController::class, 'store'])->name('locais.store');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/locais', [LocalController::class, 'show'])->name('locais.show');
    Route::put('/locais', [LocalController::class, 'update'])->name('locais.update');
    Route::delete('/locais', [LocalController::class, 'destroy'])->name('locais.destroy');

    Route::post('/locais/imagem', ImagemLocalUpload::class)->name('locais.image');

    Route::post('/objetos/{objeto}/imagem', ImagemObjetoUpload::class)->name('objetos.image');
    Route::apiResource('objetos', ObjetoController::class);
    Route::patch('/objetos/{objeto}/donos', DefinirDonoObjeto::class)->name('objetos.owner');
});

//Rotas publicas
Route::get('/locais/busca', BuscarLocais::class)->name('locais.index');
Route::get('/locais/{local}/objetos', ListarObjetosLocal::class)->name('locais.objetos.index');
