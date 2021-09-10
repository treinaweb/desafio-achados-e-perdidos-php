<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LocalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'local' => [
                'id' => $this->id,
                'nome' => $this->nome,
                'endereco' => $this->endereco,
                'contato' => $this->contato,
                'descricao' => $this->descricao,
                'imagem' => caminho_imagem($this->imagem_local),
            ],
            'usuario' => new UsuarioResource($this->user),
            'links' => [
                [
                    'type' => 'GET',
                    'rel' => 'self',
                    'uri' => route('locais.show', [], false)
                ],
                [
                    'type' => 'POST',
                    'rel' => 'cadastrar_local',
                    'uri' => route('locais.store', [], false)
                ],
                [
                    'type' => 'PUT',
                    'rel' => 'atualizar_local',
                    'uri' => route('locais.update', [], false)
                ],
                [
                    'type' => 'DELETE',
                    'rel' => 'apagar_local',
                    'uri' => route('locais.destroy', [], false)
                ],
                [
                    'type' => 'POST',
                    'rel' => 'definir_imagem_local',
                    'uri' => route('locais.image', [], false)
                ],
                [
                    'type' => 'GET',
                    'rel' => 'listar_objetos_local',
                    'uri' => route('objetos.index', [], false)
                ],
                [
                    'type' => 'POST',
                    'rel' => 'adicionar_objeto_local',
                    'uri' => route('objetos.store', [], false)
                ]
            ]
        ];
    }
}
