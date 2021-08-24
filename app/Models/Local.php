<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Local extends Model
{
    use HasFactory;

    /**
     * define a tabela
     */
    public $table = 'locais';

    /**
     * Define os campos permitidos para definição em massa
     */
    protected $fillable = ['nome', 'endereco', 'contato', 'descricao'];

    /**
     * Mapeia a relação com usuário
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mapeia a relação com objetos
     *
     * @return HasMany
     */
    public function objetos(): HasMany
    {
        return $this->hasMany(Objeto::class);
    }
}
