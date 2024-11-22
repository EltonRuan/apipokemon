<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory;

    protected $table = 'treinadores'; // Nome da tabela no banco de dados

    /**
     * Os atributos que podem ser atribuídos em massa.
     */
    protected $fillable = [
        'name',
        'lastname',
        'birthdate',
        'city',
        'username',
        'password',
        'token',
    ];

    /**
     * Esconde o campo 'password' nos retornos JSON.
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Relação: Trainer tem muitos Pokémon.
     */
    public function pokemons()
    {
        return $this->hasMany(Pokemon::class);
    }
}
