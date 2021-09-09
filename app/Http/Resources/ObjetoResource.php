<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ObjetoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return array
     */
    public function toArray($request)
    {
        $estrutura =  [
            'id' => $this->id,
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'entregue' => $this->entregue,
            'data_cadastro' => $this->created_at,
            'imagem' => caminho_imagem($this->imagem_objeto),
            'links' => [
                [
                    'type' => 'GET',
                    'rel' => 'self',
                    'uri' => route('objetos.show', $this->id, false)
                ],
            ]
        ];

        return $this->linksObjetoSemDono($estrutura);
    }

    /**
     * Adiciona os links do hateoas para produtos não entregues
     *
     * @param array $estrutura
     * @return array
     */
    private function linksObjetoSemDono(array $estrutura): array
    {
        if ($this->entregue === 0) {
            $estrutura['links'][] = [
                        'type' => 'PUT',
                        'rel' => 'atualizar_objeto',
                        'uri' => route('objetos.update', $this->id)
            ];

            $estrutura['links'][] = [
                        'type' => 'DELETE',
                        'rel' => 'apagar_objeto',
                        'uri' => route('objetos.destroy', $this->id)
            ];

            $estrutura['links'][] = [
                        'type' => 'POST',
                        'rel' => 'definir_imagem_objeto',
                        'uri' => route('objetos.image', $this->id)
            ];
        }

        
        return $estrutura;
    }
}
