<?php



if (! function_exists('caminho_imagem')) 
{
    
    function caminho_imagem(string $imagem = null): ?string
    {
        if (! $imagem) {
            return null;
        }

        return asset($imagem);
    }
}
