<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlunoTelefone extends Model
{
    use HasFactory;

    protected $fillable = [
        'aluno_id',
        'telefone',
        'tipo',
    ];

    /**
     * RELACIONAMENTO INVERSO 1:1 - O telefone pertence a um aluno
     */
    public function aluno(): BelongsTo
    {
        return $this->belongsTo(Aluno::class);
    }
}

