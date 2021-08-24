<?php

namespace App\Http\Controllers;

use App\Models\Objeto;
use App\Http\Requests\ObjetoRequest;
use App\Http\Resources\ObjetoCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\ObjetoResource;

class ObjetoController extends Controller
{
    /**
     * Lista os objetos cadastrados
     *
     * @return Collection
     */
    public function index()
    {
        $objetos = Auth::user()->local->objetos;

        return new ObjetoCollection($objetos);
    }

    /**
     * Obtem dados do objeto
     *
     * @param Objeto $objeto
     * @return ObjetoResource
     */
    public function show(Objeto $objeto): ObjetoResource
    {
        return new ObjetoResource($objeto);
    }

    /**
     * Cria um objeto no local do usuário
     *
     * @param ObjetoRequest $request
     * @return ObjetoResource
     */
    public function store(ObjetoRequest $request)
    {
        $dados = $request->all();
        $dados['entregue'] = 0;

        $local = Auth::user()->local;
        $objeto = $local->objetos()->create($dados);

        return new ObjetoResource($objeto);
    }

    /**
     * Atualiza um objeto no local do usuário
     *
     * @param ObjetoRequest $request
     * @param Objeto $objeto
     * @return ObjetoResource
     */
    public function update(ObjetoRequest $request, Objeto $objeto)
    {
        Gate::authorize('dono-objeto', $objeto);

        $dados = $request->all();
        $dados['entregue'] = 0;

        $objeto->update($dados);

        return new ObjetoResource($objeto);
    }

    /**
     * Remove um objeto do local do usuário
     *
     * @param Objeto $objeto
     * @return JsonResponse
     */
    public function destroy(Objeto $objeto)
    {
        Gate::authorize('dono-objeto', $objeto);
        
        $objeto->delete();

        return resposta_padrao(
            'objeto apagado com sucesso',
            'success',
            200
        );
    }
}
