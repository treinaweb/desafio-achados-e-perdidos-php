<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ImagemLocalUpload extends Controller
{
    /**
     * Define a imagem do local
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $request->validate([
            'imagem_local' => ['required', 'image']
        ]);

        $usuario = Auth::user();
        $usuario->local->imagem_local = $request->imagem_local->store('public');

        $usuario->local->save();

        return resposta_padrao('Imagem definida com sucesso!', 'success', 200);
    }
}
