<?php

namespace App\Http\Controllers;

use App\Models\Local;
use App\Http\Resources\ObjetoPublicoCollection;

class ListarObjetosLocal extends Controller
{
    /**
     * Lista os objetos não entregues de um local
     *
     * @param Local $local
     * @return ObjetoPublicoCollection
     */
    public function __invoke(Local $local): ObjetoPublicoCollection
    {
        $objetos = $local->objetos()->where('entregue', 0)->get();

        return new ObjetoPublicoCollection($objetos);
    }
}
