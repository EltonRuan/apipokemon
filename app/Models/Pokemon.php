<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;

    protected $table = 'pokemons'; // Nome da tabela no banco de dados

    /**
     * Os atributos que podem ser atribuídos em massa.
     */
    protected $fillable = [
        'name',
        'type',          // JSON
        'hp',
        'attack',
        'defense',
        'sp_attack',
        'sp_defense',
        'speed',
        'species',
        'description',
        'evolution',     // JSON
        'height',
        'weight',
        'egg_groups',    // JSON
        'abilities',     // JSON
        'gender_ratio',
        'image_url',
    ];

    /**
     * Casting de atributos para tipos específicos.
     */
    protected $casts = [
        'type' => 'array',
        'evolution' => 'array',
        'egg_groups' => 'array',
        'abilities' => 'array',
    ];

    /**
     * Relação: Pokémon pertence a um Trainer.
     */
    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }
}
