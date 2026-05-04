<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Disciplina extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'codigo',
        'carga_horaria',
    ];

    /**
     * RELACIONAMENTO N:N - Uma disciplina tem muitos alunos
     */
    public function alunos(): BelongsToMany
    {
        return $this->belongsToMany(
            Aluno::class,
            'disciplina_aluno',
            'disciplina_id',
            'aluno_id'
        )->withPivot('situacao', 'data_matricula')
         ->withTimestamps();
    }

    /**
     * RELACIONAMENTO 1:N - Uma disciplina tem muitas notas
     */
    public function notas(): HasMany
    {
        return $this->hasMany(Nota::class);
    }
}
