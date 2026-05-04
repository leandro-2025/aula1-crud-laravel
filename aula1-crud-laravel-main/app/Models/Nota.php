<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nota extends Model
{
    use HasFactory;

    protected $fillable = [
        'aluno_id',
        'disciplina_id',
        'valor',
        'tipo',
        'data_avaliacao',
    ];

    protected $casts = [
        'data_avaliacao' => 'date',
    ];

    /**
     * RELACIONAMENTO INVERSO - A nota pertence a um aluno
     */
    public function aluno(): BelongsTo
    {
        return $this->belongsTo(Aluno::class);
    }

    /**
     * RELACIONAMENTO INVERSO - A nota pertence a uma disciplina
     */
    public function disciplina(): BelongsTo
    {
        return $this->belongsTo(Disciplina::class);
    }
}
