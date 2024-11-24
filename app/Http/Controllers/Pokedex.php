<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use App\Models\Pokemon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Str;
    

class Pokedex extends Controller
{
    /**
     * Handle the signup of a new trainer.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signup(Request $request)
    {
        // Verifica se o username já está em uso
        if (Trainer::where('username', $request->username)->exists()) {
            return response()->json([
                'message' => 'Não foi possível realizar seu cadastro na Pokédex devido ao seu cadastro já existir, prossiga para o login na sua Pokédex'
            ], 422);
        }

        // Validação dos campos obrigatórios
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'city' => 'required|string|max:255',
            'username' => 'required|string|max:255',  // A verificação de unicidade foi feita antes
            'password' => 'required|string|min:6',
        ]);

        try {
            // Criando um novo treinador
            Trainer::create([
                'name' => $validated['name'],
                'lastname' => $validated['lastname'],
                'birthdate' => $validated['birthdate'],
                'city' => $validated['city'],
                'username' => $validated['username'],
                'password' => Hash::make($validated['password']), // Senha criptografada
            ]);

            return response()->json([
                'message' => 'Treinador, você foi registrado com sucesso na sua Pokédex'
            ], 201);
        } catch (\Exception $e) {
            // Caso ocorra outro erro
            return response()->json([
                'message' => 'Não foi possível realizar seu cadastro na Pokédex devido a informações faltando ou conflitantes',
            ], 422);
        }
    }

    public function signin(Request $request)
    {
        try {
            // Validação dos campos obrigatórios
            $validated = $request->validate([
                'username' => 'required|string|max:255',
                'password' => 'required|string|min:6',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Retornar mensagem personalizada de erro 422
            return response()->json([
                'message' => 'Treinador, faltam dados para podermos autenticar você na sua Pokédex',
            ], 422);
        }

        // Verificar se o treinador existe
        $trainer = Trainer::where('username', $validated['username'])->first();

        // Se o treinador não existir ou a senha estiver incorreta
        if (!$trainer || !Hash::check($validated['password'], $trainer->password)) {
            return response()->json([
                'message' => 'Treinador, parece que seus dados estão incorretos, confira e tente novamente',
            ], 401);
        }

        // Gerar token
        $token = Str::random(60); // Gera um token aleatório

        // Salvar o token no banco de dados
        $trainer->token = $token;
        $trainer->save();

        // Retornar o token para o treinador
        return response()->json([
            'token' => $token,
        ], 200);
    }

    public function logout(Request $request)
    {
        // Obtém o token do cabeçalho
        $authorizationHeader = $request->header('Authorization');

        // Verifica se o token foi informado
        if (!$authorizationHeader) {
            return response()->json([
                'message' => 'Treinador, faltou informar seu token',
            ], 422);
        }

        // Remove o prefixo "Bearer " do token
        $token = str_replace('Bearer ', '', $authorizationHeader);

        // Busca o treinador com o token
        $trainer = Trainer::where('token', $token)->first();

        // Verifica se o token é válido
        if (!$trainer) {
            return response()->json([
                'message' => 'Treinador, este token não é mais válido',
            ], 401);
        }

        // Remove o token do banco de dados
        $trainer->update(['token' => null]);

        return response()->json([
            'message' => 'Você saiu da sua Pokédex com sucesso',
        ], 200);
    }

    public function getTrainerData(Request $request)
    {
        // Obtém o token do cabeçalho
        $authorizationHeader = $request->header('Authorization');

        // Verifica se o token foi informado
        if (!$authorizationHeader) {
            return response()->json([
                'message' => 'Treinador, faltou informar seu token',
            ], 422);
        }

        // Remove o prefixo "Bearer " do token
        $token = str_replace('Bearer ', '', $authorizationHeader);

        // Busca o treinador com o token
        $trainer = Trainer::where('token', $token)->first();

        // Verifica se o token é válido
        if (!$trainer) {
            return response()->json([
                'message' => 'Treinador, este token não é mais válido',
            ], 401);
        }

        // Retorna os dados do treinador
        return response()->json([
            'name' => $trainer->name,
            'lastname' => $trainer->lastname,
            'birthdate' => $trainer->birthdate,
            'city' => $trainer->city,
            'username' => $trainer->username,
        ], 200);
    }

    public function savePokemon(Request $request)
    {
        // Obtém o token do cabeçalho
        $authorizationHeader = $request->header('Authorization');
    
        // Verifica se o token foi informado
        if (!$authorizationHeader) {
            return response()->json([
                'message' => 'Treinador, faltou informar seu token',
            ], 422);
        }
    
        // Remove o prefixo "Bearer " do token
        $token = str_replace('Bearer ', '', $authorizationHeader);
    
        // Verifica se o token é válido
        $trainer = Trainer::where('token', $token)->first();
        if (!$trainer) {
            return response()->json([
                'message' => 'Treinador, este token não é mais válido',
            ], 401);
        }
    
        // Validação dos campos obrigatórios
        $validatedData = $request->validate([
            'id' => 'nullable|integer', // ID pode ser nulo para novos registros
            'name' => 'nullable|array', // Nome como array para múltiplos idiomas
            'type' => 'nullable|array', // Tipos como array
            'base' => 'nullable|array', // Atributos base como array
            'species' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'evolution' => 'nullable|array', // Evoluções como array
            'profile' => 'nullable|array', // Perfil como array
            'image' => 'nullable|array', // Imagens como array
        ]);
    
        // Verifica se o Pokémon já existe
        $pokemon = Pokemon::find($validatedData['id']);
    
        if ($pokemon) {
            // Atualiza os dados do Pokémon
            $pokemon->update([
                'name' => $validatedData['name'] ?? $pokemon->name,
                'type' => $validatedData['type'] ?? $pokemon->type,
                'base' => $validatedData['base'] ?? $pokemon->base,
                'species' => $validatedData['species'] ?? $pokemon->species,
                'description' => $validatedData['description'] ?? $pokemon->description,
                'evolution' => $validatedData['evolution'] ?? $pokemon->evolution,
                'profile' => $validatedData['profile'] ?? $pokemon->profile,
                'image' => $validatedData['image'] ?? $pokemon->image,
            ]);
    
            return response()->json([
                'message' => 'Dados do Pokémon atualizados com sucesso',
            ], 200);
        } else {
            // Cria um novo Pokémon
            $validatedData['trainer_id'] = $trainer->id; // Relaciona o Pokémon ao treinador
    
            Pokemon::create($validatedData);
    
            return response()->json([
                'message' => 'Pokémon criado com sucesso na base de dados',
            ], 201);
        }
    }
    
    
    public function listPokemon(Request $request)
    {
    // Obtém o token do cabeçalho
    $authorizationHeader = $request->header('Authorization');

    // Verifica se o token foi informado
    if (!$authorizationHeader) {
        return response()->json([
            'message' => 'Treinador, faltou informar seu token',
        ], 422);
    }

    // Remove o prefixo "Bearer " do token
    $token = str_replace('Bearer ', '', $authorizationHeader);

    // Verifica se o token é válido
    $trainer = Trainer::where('token', $token)->first();
    if (!$trainer) {
        return response()->json([
            'message' => 'Treinador, este token não é mais válido',
        ], 401);
    }

    // Consulta os Pokémon cadastrados na base de dados
    $pokemons = Pokemon::select('id', 'name', 'image')
        ->where('trainer_id', $trainer->id) // Filtra pelos Pokémon do treinador
        ->get()
        ->map(function ($pokemon) {
            return [
                'id' => $pokemon->id,
                'name' => [
                    'english' => $pokemon->name['english'] ?? null,
                ],
                'image' => [
                    'hires' => $pokemon->image['hires'] ?? null,
                ],
            ];
        });

    return response()->json($pokemons, 200);
}

    
}
