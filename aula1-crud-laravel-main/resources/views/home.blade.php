@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row text-center mb-5">
        <div class="col-md-12">
            <h1 class="display-4">🎓 Sistema de Gestão de Alunos</h1>
            <p class="lead text-muted">Laravel 12 - CRUD com Relacionamentos</p>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <!-- Card CRUD Alunos -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <h3>📋 CRUD Alunos</h3>
                    <p class="text-muted">Gerenciar dados de alunos e telefones</p>
                    <p class="small">
                        ✅ Criar<br>
                        ✅ Ler<br>
                        ✅ Atualizar<br>
                        ✅ Deletar
                    </p>
                    <a href="{{ route('alunos.index') }}" class="btn btn-primary w-100">
                        Acessar CRUD →
                    </a>
                </div>
            </div>
        </div>

        <!-- Card Testes de Relacionamentos -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <h3>🔗 Relacionamentos</h3>
                    <p class="text-muted">Testar associações entre tabelas</p>
                    <p class="small">
                        1️⃣ Um para Um<br>
                        1️⃣ → ∞ Um para Muitos<br>
                        ∞ ↔ ∞ Muitos para Muitos
                    </p>
                    <a href="{{ url('/testar-relacionamentos') }}" class="btn btn-success w-100">
                        Ver Testes →
                    </a>
                </div>
            </div>
        </div>

        <!-- Card Documentação -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <h3>📚 Documentação</h3>
                    <p class="text-muted">Guia completo do sistema</p>
                    <p class="small">
                        📖 Rotas<br>
                        📖 Controllers<br>
                        📖 Models<br>
                        📖 Validações
                    </p>
                    <a href="#" class="btn btn-info w-100" disabled>
                        Em Desenvolvimento
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Seção de Rotas Rápidas -->
    <div class="row mb-5">
        <div class="col-md-12">
            <h4 class="mb-3">🚀 Acesso Rápido às Rotas:</h4>
            <div class="list-group">
                <a href="{{ route('alunos.index') }}" class="list-group-item list-group-item-action">
                    <strong>GET /alunos</strong> - Listar alunos
                </a>
                <a href="{{ route('alunos.create') }}" class="list-group-item list-group-item-action">
                    <strong>GET /alunos/create</strong> - Formulário criar aluno
                </a>
                <a href="{{ url('/testar-relacionamentos') }}" class="list-group-item list-group-item-action">
                    <strong>GET /testar-relacionamentos</strong> - Teste de relacionamentos
                </a>
                <a href="{{ url('/aluno/1/media') }}" class="list-group-item list-group-item-action">
                    <strong>GET /aluno/{id}/media</strong> - Calcular média do aluno
                </a>
                <a href="{{ url('/disciplina/1/alunos') }}" class="list-group-item list-group-item-action">
                    <strong>GET /disciplina/{id}/alunos</strong> - Listar alunos de uma disciplina
                </a>
                <a href="{{ url('/listar-alunos') }}" class="list-group-item list-group-item-action">
                    <strong>GET /listar-alunos</strong> - Teste de Eager Loading
                </a>
            </div>
        </div>
    </div>

    <!-- Informações do Projeto -->
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info border-0">
                <h5>📌 Informações do Projeto:</h5>
                <ul class="mb-0">
                    <li><strong>Framework:</strong> Laravel 12</li>
                    <li><strong>Database:</strong> MySQL</li>
                    <li><strong>Frontend:</strong> Bootstrap 5 + Blade Templates</li>
                    <li><strong>Objetivo:</strong> Ensino de CRUD e Relacionamentos em Curso Técnico ADS</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
