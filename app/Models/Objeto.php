<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Objeto extends Model
{
    use HasFactory;

    /**
     * Define os campos permitidos para definição em massa
     */
    protected $fillable = ['nome', 'descricao', 'entregue'];

    /**
     * Define a relação com o local
     *
     * @return BelongsTo
     */
    public function local(): BelongsTo
    {
        return $this->belongsTo(Local::class);
    }
}
