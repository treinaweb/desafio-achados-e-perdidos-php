<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LocalPublicoResource extends JsonResource
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
            'id' => $this->id,
            'nome' => $this->nome,
            'endereco' => $this->endereco,
            'contato' => $this->contato,
            'descricao' => $this->descricao,
            'imagem' => caminho_imagem($this->imagem_local),
            'links' => [
                [
                    'type' => 'GET',
                    'rel' => 'objetos_local',
                    'uri' => route('locais.objetos.index', $this->id)
                ]
            ]
        ];
    }
}
