<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TreinadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('treinadores')->insert([
            [
                'name' => 'Ash',
                'lastname' => 'Ketchum',
                'birthdate' => '1986-05-22',
                'city' => 'Pallet',
                'username' => 'ash_ketchum86',
                'password' => Hash::make('1234'), // Armazena a senha de forma segura
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Adicione mais treinadores se necessário
        ]);
    }
}
