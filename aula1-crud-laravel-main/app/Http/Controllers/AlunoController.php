<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\AlunoTelefone;
use App\Models\Disciplina;
use App\Models\Nota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlunoController extends Controller
{
    /**
     * Testar todos os relacionamentos
     */
    public function testarRelacionamentos()
    {
        echo "<h1>Teste de Relacionamentos</h1>";
        echo "<hr>";

        // Gerar email e código únicos usando timestamp
        $timestamp = time();
        $codigo_pw = 'PW' . $timestamp;
        $codigo_bd = 'BD' . $timestamp;

        // 1. Criar um aluno
        echo "<h2>1. Criando Aluno</h2>";
        $aluno = Aluno::create([
            'nome' => 'João Silva',
            'email' => 'joao.silva.' . $timestamp . '@email.com',
            'data_nascimento' => '2000-05-15',
        ]);
        echo "Aluno criado: {$aluno->nome} (ID: {$aluno->id})<br>";
        echo "Idade: {$aluno->idade} anos<br><br>";

        // 2. RELACIONAMENTO 1:1 - Criar telefone para o aluno
        echo "<h2>2. Relacionamento 1:1 - AlunoTelefone</h2>";
        $telefone = AlunoTelefone::create([
            'aluno_id' => $aluno->id,
            'telefone' => '(11) 98765-4321',
            'tipo' => 'celular',
        ]);
        echo "Telefone criado: {$telefone->telefone}<br>";

        // Buscar telefone através do aluno
        $alunoComTelefone = Aluno::with('telefone')->find($aluno->id);
        echo "Telefone do aluno: " . $alunoComTelefone->telefone->telefone . "<br><br>";

        // 3. Criar disciplinas
        echo "<h2>3. Criando Disciplinas</h2>";
        $disciplina1 = Disciplina::create([
            'nome' => 'Programação Web',
            'codigo' => $codigo_pw,
            'carga_horaria' => 80,
        ]);

        $disciplina2 = Disciplina::create([
            'nome' => 'Banco de Dados',
            'codigo' => $codigo_bd,
            'carga_horaria' => 60,
        ]);

        echo "Disciplinas criadas: {$disciplina1->nome}, {$disciplina2->nome}<br><br>";

        // 4. RELACIONAMENTO N:N - Matricular aluno em disciplinas
        echo "<h2>4. Relacionamento N:N - Disciplina-Aluno</h2>";
        $aluno->disciplinas()->attach($disciplina1->id, [
            'situacao' => 'matriculado',
            'data_matricula' => now(),
        ]);

        $aluno->disciplinas()->attach($disciplina2->id, [
            'situacao' => 'matriculado',
            'data_matricula' => now(),
        ]);

        echo "Aluno matriculado em " . $aluno->disciplinas->count() . " disciplinas<br>";
        foreach ($aluno->disciplinas as $disc) {
            echo "- {$disc->nome} ({$disc->pivot->situacao})<br>";
        }
        echo "<br>";

        // 5. RELACIONAMENTO 1:N - Criar notas para o aluno
        echo "<h2>5. Relacionamento 1:N - Notas</h2>";
        Nota::create([
            'aluno_id' => $aluno->id,
            'disciplina_id' => $disciplina1->id,
            'valor' => 8.5,
            'tipo' => 'Prova 1',
            'data_avaliacao' => '2024-03-15',
        ]);

        Nota::create([
            'aluno_id' => $aluno->id,
            'disciplina_id' => $disciplina1->id,
            'valor' => 9.0,
            'tipo' => 'Prova 2',
            'data_avaliacao' => '2024-05-20',
        ]);

        Nota::create([
            'aluno_id' => $aluno->id,
            'disciplina_id' => $disciplina2->id,
            'valor' => 7.5,
            'tipo' => 'Prova 1',
            'data_avaliacao' => '2024-04-10',
        ]);

        echo "Notas criadas: " . $aluno->notas->count() . " notas<br>";

        // Buscar aluno com todas as relações
        $alunoCompleto = Aluno::with(['telefone', 'notas.disciplina', 'disciplinas'])
            ->find($aluno->id);

        echo "<br><strong>Resumo do Aluno:</strong><br>";
        echo "Nome: {$alunoCompleto->nome}<br>";
        echo "Telefone: {$alunoCompleto->telefone->telefone}<br>";
        echo "Disciplinas: " . $alunoCompleto->disciplinas->count() . "<br>";
        echo "Total de Notas: " . $alunoCompleto->notas->count() . "<br><br>";

        echo "<h3>Notas por Disciplina:</h3>";
        foreach ($alunoCompleto->notas as $nota) {
            echo "{$nota->disciplina->nome} - {$nota->tipo}: {$nota->valor}<br>";
        }

        return;
    }

    /**
     * Exemplo: Buscar média do aluno por disciplina
     */
    public function calcularMedia($alunoId)
    {
        $aluno = Aluno::with('notas.disciplina')->find($alunoId);

        if (!$aluno) {
            return "Aluno não encontrado!";
        }

        echo "<h1>Médias do Aluno: {$aluno->nome}</h1><hr>";

        $medias = [];
        foreach ($aluno->notas as $nota) {
            $disciplinaNome = $nota->disciplina->nome;
            if (!isset($medias[$disciplinaNome])) {
                $medias[$disciplinaNome] = [];
            }
            $medias[$disciplinaNome][] = $nota->valor;
        }

        foreach ($medias as $disciplina => $notas) {
            $media = array_sum($notas) / count($notas);
            echo "{$disciplina}: Média = " . number_format($media, 2) . "<br>";
        }

        return;
    }

    /**
     * Exemplo: Listar alunos matriculados em uma disciplina
     */
    public function alunosPorDisciplina($disciplinaId)
    {
        $disciplina = Disciplina::with(['alunos.telefone', 'alunos.notas'])
            ->find($disciplinaId);

        if (!$disciplina) {
            return "Disciplina não encontrada!";
        }

        echo "<h1>Alunos matriculados em: {$disciplina->nome}</h1><hr>";
        echo "Total: " . $disciplina->alunos->count() . " alunos<br><br>";

        foreach ($disciplina->alunos as $aluno) {
            echo "<strong>{$aluno->nome}</strong><br>";
            echo "Telefone: " . ($aluno->telefone->telefone ?? 'N/A') . "<br>";
            echo "Matrícula: {$aluno->pivot->data_matricula}<br>";
            echo "Situação: {$aluno->pivot->situacao}<br>";
            echo "<br>";
        }

        return;
    }

    /**
     * Exemplo: Eager Loading - Evitar N+1 queries
     */
    public function listarComEagerLoading()
    {
        // SEM eager loading (problema N+1)
        echo "<h2>SEM Eager Loading (N+1 queries)</h2>";
        $alunos = Aluno::all();
        foreach ($alunos as $aluno) {
            echo "{$aluno->nome} - Telefone: " . ($aluno->telefone->telefone ?? 'N/A');
            echo "<br>";
        }

        echo "<br><h2>COM Eager Loading (1 query)</h2>";
        // COM eager loading (otimizado)
        $alunos = Aluno::with(['telefone', 'disciplinas', 'notas'])->get();
        foreach ($alunos as $aluno) {
            echo "{$aluno->nome} - Telefone: " . ($aluno->telefone->telefone ?? 'N/A');
            echo " - Disciplinas: " . $aluno->disciplinas->count();
            echo "<br>";
        }

        return;
    }
}
