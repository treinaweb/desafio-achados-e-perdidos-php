<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\LocalResource;
use App\Http\Requests\LocalCadastroRequest;
use App\Http\Requests\LocalAlteracaoRequest;

class LocalController extends Controller
{
    /**
     * Cria um local e seu usuário
     *
     * @param LocalCadastroRequest $request
     * @return LocalResource
     */
    public function store(LocalCadastroRequest $request): LocalResource
    {
        $usuario = DB::transaction(function() use ($request) {
            $dadosUsuario = $request->usuario;
            $dadosUsuario['password'] = Hash::make($dadosUsuario['password']);

            $usuario = User::create($dadosUsuario);

            $usuario->local()->create($request->local);

            return $usuario;
        });

        return new LocalResource($usuario->local);
    }

    /**
     * Retorna o local do usuário
     *
     * @return LocalResource
     */
    public function show(): LocalResource
    {
        return new LocalResource(Auth::user()->local);
    }

    /**
     * Atualiza o local do usuário
     *
     * @param LocalAlteracaoRequest $request
     * @return LocalResource
     */
    public function update(LocalAlteracaoRequest $request): LocalResource
    {
        $usuario = Auth::user();

        DB::transaction(function() use ($request, $usuario) {
            $dadosUsuario = $request->usuario;

            if ($request->has('usuario.password')) {
                $dadosUsuario['password'] = Hash::make($dadosUsuario['password']);
            }

            $usuario->update($dadosUsuario);

            $usuario->local->update($request->local);
        });

        return new LocalResource($usuario->local);
    }

    /**
     * Apaga o local e a conta do usuário
     *
     * @return JsonResponse
     */
    public function destroy(): JsonResponse
    {
        $usuario = Auth::user();

        $usuario->delete();

        return resposta_padrao(
            'Local e usuário apagado com sucesso',
            'success',
            200
        );
    }
}
