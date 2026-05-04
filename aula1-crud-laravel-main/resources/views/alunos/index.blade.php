@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>📚 Gerenciar Alunos</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('alunos.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Novo Aluno
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($alunos->isEmpty())
        <div class="alert alert-info">
            Nenhum aluno cadastrado. <a href="{{ route('alunos.create') }}">Clique aqui para criar um</a>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Data Nascimento</th>
                        <th>Telefone</th>
                        <th style="width: 150px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($alunos as $aluno)
                        <tr>
                            <td>{{ $aluno->id }}</td>
                            <td>{{ $aluno->nome }}</td>
                            <td>{{ $aluno->email }}</td>
                            <td>{{ $aluno->data_nascimento->format('d/m/Y') }}</td>
                            <td>
                                @if($aluno->telefone)
                                    <span class="badge bg-success">{{ $aluno->telefone->telefone }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('alunos.edit', $aluno->id) }}" class="btn btn-sm btn-warning">
                                    ✏️ Editar
                                </a>
                                <form action="{{ route('alunos.destroy', $aluno->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">
                                        🗑️ Deletar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
