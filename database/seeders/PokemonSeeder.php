<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PokemonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pokemons')->insert([
            [
                'name' => json_encode([
                    'english' => 'Bulbasaur',
                    'japanese' => 'フシギダネ',
                    'chinese' => '妙蛙种子',
                    'french' => 'Bulbizarre',
                ]),
                'type' => json_encode(['Grass', 'Poison']),
                'base' => json_encode([
                    'HP' => 45,
                    'Attack' => 49,
                    'Defense' => 49,
                    'Sp. Attack' => 65,
                    'Sp. Defense' => 65,
                    'Speed' => 45,
                ]),
                'species' => 'Seed Pokémon',
                'description' => 'Bulbasaur can be seen napping in bright sunlight. There is a seed on its back. By soaking up the sun’s rays, the seed grows progressively larger.',
                'evolution' => json_encode(['next' => [['2', 'Level 16']]]),
                'profile' => json_encode([
                    'height' => '0.7 m',
                    'weight' => '6.9 kg',
                    'egg' => ['Monster', 'Grass'],
                    'ability' => [
                        ['Overgrow', 'false'],
                        ['Chlorophyll', 'true'],
                    ],
                    'gender' => '87.5:12.5',
                ]),
                'image' => json_encode([
                    'sprite' => 'https://raw.githubusercontent.com/Purukitto/pokemon-data.json/master/images/pokedex/sprites/001.png',
                    'thumbnail' => 'https://raw.githubusercontent.com/Purukitto/pokemon-data.json/master/images/pokedex/thumbnails/001.png',
                    'hires' => 'https://raw.githubusercontent.com/Purukitto/pokemon-data.json/master/images/pokedex/hires/001.png',
                ]),
                'trainer_id' => 1, // Associa ao treinador com ID 1
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Adicione mais Pokémons se necessário
        ]);
    }
}
