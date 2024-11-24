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
        'type',
        'base',
        'species',
        'description',
        'evolution',
        'profile',
        'image',
        'trainer_id',
    ];
    
    protected $casts = [
        'name' => 'array',
        'type' => 'array',
        'base' => 'array',
        'evolution' => 'array',
        'profile' => 'array',
        'image' => 'array',
    ];
    
    

    /**
     * Relação: Pokémon pertence a um Trainer.
     */
    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }
}
