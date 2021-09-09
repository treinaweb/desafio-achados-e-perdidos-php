<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return [
            'links' => [
                [
                    'type' => 'POST',
                    'rel' => 'criar_local',
                    'uri' => route('locais.store', [], false)
                ],
                [
                    'type' => 'GET',
                    'rel' => 'buscar_locais',
                    'uri' => route('locais.index', [], false)
                ]
            ]
        ];
    }
}
