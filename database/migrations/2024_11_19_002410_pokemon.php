<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Tabela treinadores
        Schema::create('treinadores', function (Blueprint $table) {
            $table->id(); // ID único
            $table->string('name'); // Nome do treinador
            $table->string('lastname'); // Sobrenome
            $table->date('birthdate'); // Data de nascimento
            $table->string('city'); // Cidade
            $table->string('username')->unique(); // Nome de usuário único
            $table->string('password'); // Senha (será armazenada criptografada)
            $table->string('token')->nullable();
            $table->timestamps(); // Campos created_at e updated_at
        });

        Schema::create('pokemons', function (Blueprint $table) {
            $table->id();
            $table->json('name')->nullable();
            $table->json('type')->nullable();
            $table->json('base')->nullable();
            $table->string('species')->nullable();
            $table->text('description')->nullable();
            $table->json('evolution')->nullable();
            $table->json('profile')->nullable();
            $table->json('image')->nullable();
            $table->foreignId('trainer_id')->constrained('treinadores')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('treinadores');
        Schema::dropIfExists('pokemons');
    }
};

