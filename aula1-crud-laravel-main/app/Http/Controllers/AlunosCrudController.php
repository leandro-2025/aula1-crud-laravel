<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\AlunoTelefone;
use Illuminate\Http\Request;

class AlunosCrudController extends Controller
{
    /**
     * Listar todos os alunos
     */
    public function index()
    {
        $alunos = Aluno::with('telefone')->get();
        return view('alunos.index', compact('alunos'));
    }

    /**
     * Mostrar formulário para criar aluno
     */
    public function create()
    {
        return view('alunos.form');
    }

    /**
     * Salvar aluno no banco de dados
     */
    public function store(Request $request)
    {
        // Validar dados
        $validated = $request->validate([
            'nome' => 'required|string|max:100',
            'email' => 'required|email|unique:alunos,email',
            'data_nascimento' => 'required|date|before:today',
            'telefone' => 'nullable|string|max:20',
            'tipo' => 'nullable|string|in:celular,residencial,comercial',
        ], [
            'nome.required' => 'O nome é obrigatório',
            'email.required' => 'O email é obrigatório',
            'email.unique' => 'Este email já está cadastrado',
            'data_nascimento.required' => 'A data de nascimento é obrigatória',
        ]);

        // Criar aluno
        $aluno = Aluno::create([
            'nome' => $validated['nome'],
            'email' => $validated['email'],
            'data_nascimento' => $validated['data_nascimento'],
        ]);

        // Criar telefone se informado
        if ($validated['telefone']) {
            AlunoTelefone::create([
                'aluno_id' => $aluno->id,
                'telefone' => $validated['telefone'],
                'tipo' => $validated['tipo'] ?? 'celular',
            ]);
        }

        return redirect()->route('alunos.index')
                        ->with('success', "Aluno '{$aluno->nome}' criado com sucesso!");
    }

    /**
     * Mostrar formulário para editar aluno
     */
    public function edit(Aluno $aluno)
    {
        $aluno = $aluno->load('telefone');
        return view('alunos.form', compact('aluno'));
    }

    /**
     * Atualizar aluno no banco de dados
     */
    public function update(Request $request, Aluno $aluno)
    {
        // Validar dados
        $validated = $request->validate([
            'nome' => 'required|string|max:100',
            'email' => 'required|email|unique:alunos,email,' . $aluno->id,
            'data_nascimento' => 'required|date|before:today',
            'telefone' => 'nullable|string|max:20',
            'tipo' => 'nullable|string|in:celular,residencial,comercial',
        ]);

        // Atualizar aluno
        $aluno->update([
            'nome' => $validated['nome'],
            'email' => $validated['email'],
            'data_nascimento' => $validated['data_nascimento'],
        ]);

        // Atualizar ou criar telefone
        if ($validated['telefone']) {
            if ($aluno->telefone) {
                $aluno->telefone->update([
                    'telefone' => $validated['telefone'],
                    'tipo' => $validated['tipo'] ?? 'celular',
                ]);
            } else {
                AlunoTelefone::create([
                    'aluno_id' => $aluno->id,
                    'telefone' => $validated['telefone'],
                    'tipo' => $validated['tipo'] ?? 'celular',
                ]);
            }
        } elseif ($aluno->telefone) {
            // Deletar telefone se deixou em branco
            $aluno->telefone->delete();
        }

        return redirect()->route('alunos.index')
                        ->with('success', "Aluno '{$aluno->nome}' atualizado com sucesso!");
    }

    /**
     * Deletar aluno
     */
    public function destroy(Aluno $aluno)
    {
        $nome = $aluno->nome;
        
        // Deletar telefone associado (se houver)
        if ($aluno->telefone) {
            $aluno->telefone->delete();
        }
        
        // Deletar aluno
        $aluno->delete();

        return redirect()->route('alunos.index')
                        ->with('success', "Aluno '{$nome}' deletado com sucesso!");
    }
}
