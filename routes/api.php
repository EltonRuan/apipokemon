<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pokedex;

Route::post('/signup', [Pokedex::class, 'signup']);

Route::post('/signin', [Pokedex::class, 'signin']);

Route::get('/logout', [Pokedex::class, 'logout']);

Route::get('/trainer/data', [Pokedex::class, 'getTrainerData']);

/* */

Route::post('/pokemon/read', [Pokedex::class, 'savePokemon']);

