<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('disciplina_aluno', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aluno_id')->constrained()->onDelete('cascade');
            $table->foreignId('disciplina_id')->constrained()->onDelete('cascade');
            $table->string('situacao', 20)->default('matriculado');
            $table->date('data_matricula');
            $table->unique(['aluno_id', 'disciplina_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disciplina_aluno');
    }
};
