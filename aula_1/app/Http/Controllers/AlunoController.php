<?php

namespace App\Http\Controllers;

use App\Models\Aluno;

class AlunoController extends Controller
{
    /**
     * Testar todos os relacionamentos
     */

    public function testarRelacionamentos()
    {

        echo "<h1>Teste de Relacionamentos</h1>";
        echo "<hr>";

        // 1. Criar um aluno

        echo "<h2>1. Criando Aluno</h2>";

        $aluno = Aluno::create([
            'nome' => 'João Silva',
            'email' => 'joao.silva@email.com',
            'data_nascimento' => '2000-05-15',
        ]);

        echo "Aluno criado: {$aluno->nome} (ID: {$aluno->id})<br>";
        echo "Idade: {$aluno->idade} anos<br><br>";
    }
}
