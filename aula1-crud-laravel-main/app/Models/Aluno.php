<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Aluno extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'email',
        'data_nascimento',
    ];

    protected $casts = [
        'data_nascimento' => 'date',
    ];

    /**
     * RELACIONAMENTO 1:1 - Um aluno tem um telefone principal
     */
    public function telefone(): HasOne
    {
        return $this->hasOne(AlunoTelefone::class);
    }

    /**
     * RELACIONAMENTO 1:N - Um aluno tem muitas notas
     */
    public function notas(): HasMany
    {
        return $this->hasMany(Nota::class);
    }

    /**
     * RELACIONAMENTO N:N - Um aluno tem muitas disciplinas
     */
    public function disciplinas(): BelongsToMany
    {
        return $this->belongsToMany(
            Disciplina::class,
            'disciplina_aluno',
            'aluno_id',
            'disciplina_id'
        )->withPivot('situacao', 'data_matricula')
         ->withTimestamps();
    }

    /**
     * Accessor - Retorna a idade do aluno
     */
    public function getIdadeAttribute(): int
    {
        return $this->data_nascimento->age;
    }
}
