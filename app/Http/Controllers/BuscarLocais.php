<?php

namespace App\Http\Controllers;

use App\Models\Local;
use Illuminate\Http\Request;
use App\Http\Resources\LocalPublicoCollection;

class BuscarLocais extends Controller
{
    /**
     * Busca locais por nome.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return LocalPublicoCollection
     */
    public function __invoke(Request $request): LocalPublicoCollection
    {
        $termoBusca = "%$request->nome%";
        $locais = Local::where('nome', 'like', $termoBusca)->get();

        return new LocalPublicoCollection($locais);
    }
}
