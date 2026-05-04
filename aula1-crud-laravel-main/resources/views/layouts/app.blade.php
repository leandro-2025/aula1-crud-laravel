<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CRUD Alunos - Laravel')</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        h1, h4 {
            color: #667eea;
            font-weight: bold;
        }

        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .btn-primary {
            background-color: #667eea;
            border-color: #667eea;
        }

        .btn-primary:hover {
            background-color: #764ba2;
            border-color: #764ba2;
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }

        .badge {
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark navbar-expand-lg mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('alunos.index') }}">
                🎓 Sistema de Alunos
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('alunos.index') ? 'active' : '' }}" 
                           href="{{ route('alunos.index') }}">
                            📋 Alunos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('alunos.create') }}">
                            ➕ Novo Aluno
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-center mt-5 text-white">
        <p>🎓 Sistema de Gestão de Alunos | Laravel CRUD ADS</p>
    </footer>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
