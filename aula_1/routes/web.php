<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlunoController;

Route::get('/', function () {
    return view('welcome');
});
//route/web.php
//http://127.0.0.1:8000/alunos/teste-relacionamentos
Route::get('/alunos/teste-relacionamentos', [AlunoController::class, 'testarRelacionamentos']);
