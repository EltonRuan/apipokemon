<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Tabela treinadores
        Schema::create('treinadores', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('lastname', 255);
            $table->date('birthdate');
            $table->string('city', 255);
            $table->string('username', 255)->unique();
            $table->string('password', 255);
            $table->string('token', 255)->nullable();
            $table->timestamps();
        });

        // Tabela pokemons
        Schema::create('pokemons', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->json('type')->nullable(); // JSON para armazenar tipos
            $table->integer('hp')->nullable();
            $table->integer('attack')->nullable();
            $table->integer('defense')->nullable();
            $table->integer('sp_attack')->nullable();
            $table->integer('sp_defense')->nullable();
            $table->integer('speed')->nullable();
            $table->string('species', 255)->nullable();
            $table->text('description')->nullable();
            $table->json('evolution')->nullable(); // JSON para armazenar evolução
            $table->string('height', 255)->nullable();
            $table->string('weight', 255)->nullable();
            $table->json('egg_groups')->nullable(); // JSON para grupos de ovo
            $table->json('abilities')->nullable(); // JSON para habilidades
            $table->string('gender_ratio', 255)->nullable();
            $table->string('image_url', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pokemons');
        Schema::dropIfExists('treinadores');
    }
};

