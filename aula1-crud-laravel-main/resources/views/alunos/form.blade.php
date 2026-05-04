@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1>{{ isset($aluno) ? '✏️ Editar Aluno' : '➕ Novo Aluno' }}</h1>
            <hr>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ isset($aluno) ? route('alunos.update', $aluno->id) : route('alunos.store') }}" 
                  method="POST" class="needs-validation">
                @csrf
                @if(isset($aluno))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome Completo <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nome') is-invalid @enderror" 
                           id="nome" name="nome" value="{{ old('nome', $aluno->nome ?? '') }}" required>
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email', $aluno->email ?? '') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="data_nascimento" class="form-label">Data de Nascimento <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('data_nascimento') is-invalid @enderror" 
                           id="data_nascimento" name="data_nascimento" 
                           value="{{ old('data_nascimento', isset($aluno) ? $aluno->data_nascimento->format('Y-m-d') : '') }}" required>
                    @error('data_nascimento')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr>
                <h4>📞 Telefone</h4>

                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control @error('telefone') is-invalid @enderror" 
                           id="telefone" name="telefone" placeholder="(11) 98765-4321"
                           value="{{ old('telefone', $aluno->telefone->telefone ?? '') }}">
                    @error('telefone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tipo" class="form-label">Tipo de Telefone</label>
                    <select class="form-select" id="tipo" name="tipo">
                        <option value="celular" {{ old('tipo', $aluno->telefone->tipo ?? 'celular') == 'celular' ? 'selected' : '' }}>Celular</option>
                        <option value="residencial" {{ old('tipo', $aluno->telefone->tipo ?? '') == 'residencial' ? 'selected' : '' }}>Residencial</option>
                        <option value="comercial" {{ old('tipo', $aluno->telefone->tipo ?? '') == 'comercial' ? 'selected' : '' }}>Comercial</option>
                    </select>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('alunos.index') }}" class="btn btn-secondary">
                        ← Voltar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        {{ isset($aluno) ? '💾 Atualizar' : '✅ Criar Aluno' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
