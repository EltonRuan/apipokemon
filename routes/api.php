<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pokedex;

Route::post('/signup', [Pokedex::class, 'signup']);

Route::post('/signup', [Pokedex::class, 'signup']);
