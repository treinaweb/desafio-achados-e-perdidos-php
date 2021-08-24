<?php

namespace App\Http\Controllers;

use App\Models\Objeto;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class ImagemObjetoUpload extends Controller
{
    /**
     * Define a imagem de um objeto
     *
     * @param Request $request
     * @param Objeto $objeto
     * @return JsonResponse
     */
    public function __invoke(Request $request, Objeto $objeto): JsonResponse
    {
        Gate::authorize('dono-objeto', $objeto);
        
        $request->validate([
            'imagem_objeto' => ['required', 'image']
        ]);

        $objeto->imagem_objeto = $request->imagem_objeto->store('public');
        $objeto->save();

        return resposta_padrao('Imagem definida com sucesso!', 'success', 200);
    }
}
