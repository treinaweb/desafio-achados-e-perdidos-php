<?php

namespace App\Http\Controllers;

use App\Models\Objeto;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\DonoRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class DefinirDonoObjeto extends Controller
{
    /**
     * Define o dono de um objeto caso ainda não esteja definido
     *
     * @param  DonoRequest  $request
     * @return JsonResponse
     */
    public function __invoke(DonoRequest $request, Objeto $objeto): JsonResponse
    {
        Gate::authorize('dono-objeto', $objeto);

        if ($objeto->entregue === 1) {
            throw ValidationException::withMessages([
                'entregue' => 'esse objeto já foi entregue ao dono'
            ]);
        }

        $objeto->dono_nome = $request->dono_nome;
        $objeto->dono_cpf = $request->dono_cpf;
        $objeto->entregue = 1;
        $objeto->save();

        return resposta_padrao(
            'Dono do objeto definido com sucesso', 
            'success', 
            200
        );
    }
}
