### **Descrição do Projeto: API Pokémon - São Paulo Skills 2024**

O **API Pokémon - São Paulo Skills 2024** é um projeto desenvolvido como parte de um simulado prático da competição São Paulo Skills 2024, voltado para a criação e manipulação de uma API RESTful que gerencia dados de treinadores e Pokémon. O objetivo é simular um sistema de registro e consulta inspirado no universo Pokémon, promovendo o desenvolvimento de habilidades em programação e lógica.

---

### **Contexto da Competição**
A **São Paulo Skills** é uma competição que desafia jovens profissionais a demonstrar suas competências técnicas em diversas áreas, incluindo programação. Este projeto simula cenários reais, permitindo que os participantes testem suas habilidades em desenvolvimento de APIs.

---

### **Tecnologias Utilizadas**
- **PHP**  
- **MySQL**  
- **Laravel**  
- **Postman**  
- **Composer**  
- **Visual Studio Code**  
- **XAMPP**  
- **MySQL Workbench**

---

### **Instalação e Configuração**
#### **Pré-requisitos**
- PHP 7.4 ou superior.  
- MySQL instalado.  
- Composer.  

#### **Passo a Passo**
1. **Clone o Repositório**:
   
bash
   git clone https://github.com/EltonRuan/apipokemon/


2. **Instale as Dependências**:
   
bash
   composer install


3. **Configure o Arquivo .env**:
   Atualize as credenciais de banco de dados:
   
plaintext
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=apipokemon
   DB_USERNAME=root
   DB_PASSWORD=


4. **Execute as Migrações**:
   
bash
   php artisan migrate


5. **Inicie o Servidor**:
   
bash
   php artisan serve


---

### **Rotas e Retornos**
#### **1. Cadastro de Treinador**
- **Método:** POST  
- **Rota:** /api/signup

**Payload**:
json
{
    "name": "Elton",
    "lastname": "Santos",
    "birthdate": "2023-10-14",
    "city": "city1",
    "username": "EltonRuan",
    "password": "pass12345"
}


**Retornos**:
1. **Sucesso**:
   
json
   {
       "message": "Treinador, você foi registrado com sucesso na sua Pokédex"
   }

2. **Erro - Usuário já cadastrado**:
   
json
   {
       "message": "Não foi possível realizar seu cadastro na Pokédex devido ao seu cadastro já existir, prossiga para o login na sua Pokédex"
   }

3. **Erro - Dados faltantes**:
   
json
   {
       "message": "Não foi possível realizar seu cadastro na Pokédex devido a informações faltando ou conflitantes"
   }


---

#### **2. Login de Treinador**
- **Método:** POST  
- **Rota:** /api/signin

**Payload**:
json
{
    "username": "EltonRuan",
    "password": "pass12345"
}


**Retornos**:
1. **Sucesso**:
   
json
   {
       "token": "5PMhamPSxmxOO3B0affSyTAN1xtZHM2adgcoFpRgjUII1QeC6GqlArSFrbqS"
   }

2. **Erro - Dados incorretos ou faltantes**:
   
json
   {
       "message": "Treinador, faltam dados para autenticar você na sua Pokédex"
   }


---

#### **3. Logout de Treinador**
- **Método:** GET  
- **Rota:** /api/logout  
- **Header:** Authorization Bearer {{$token}}

**Retornos**:
1. **Sucesso**:
   
json
   {
       "message": "Você saiu da sua Pokédex com sucesso"
   }

2. **Erro - Token inválido ou ausente**:
   
json
   {
       "message": "Treinador, este token não é mais válido"
   }


---

#### **4. Dados do Treinador**
- **Método:** GET  
- **Rota:** /api/trainer/data  
- **Header:** Authorization Bearer {{$token}}

**Retornos**:
1. **Sucesso**:
   
json
   {
       "name": "Elton",
       "lastname": "Santos",
       "birthdate": "2023-10-14",
       "city": "city1",
       "username": "EltonRuan"
   }

2. **Erro - Token inválido ou ausente**:
   
json
   {
       "message": "Treinador, este token não é mais válido"
   }


---

#### **5. Criação ou Edição de Pokémon**
- **Método:** POST  
- **Rota:** /api/pokemon/create-or-update  
- **Header:** Authorization Bearer {{$token}}

**Payload**:
- **Criação**:
  
json
  {
      "id": null,
      "name": {"english": "Pikachu", "jp": "ピカチュウ"},
      "type": ["Electric"],
      "base": {"HP": 35, "Attack": 55, "Defense": 40},
      "species": "Mouse Pokémon",
      "description": "Pikachu that can generate powerful electricity.",
      "evolution": [{"level": 1, "name": "Pichu"}, {"level": 2, "name": "Pikachu"}],
      "profile": {"height": "0.4m", "weight": "6.0kg"},
      "image": {"hires": "pikachu-front.png"}
  }

- **Edição**:
  
json
  {
      "id": 2,
      "name": {"english": "Pikachu", "jp": "ピカチュウ"},
      ...
  }


**Retornos**:
1. **Sucesso - Pokémon Criado**:
   
json
   {
       "message": "Pokémon adicionado com sucesso!"
   }

2. **Sucesso - Pokémon Atualizado**:
   
json
   {
       "message": "Pokémon atualizado com sucesso!"
   }

3. **Erro - Token inválido ou dados faltantes**:
   
json
   {
       "message": "Erro ao processar o Pokémon. Verifique os dados enviados."
   }


---

#### **6. Listagem de Pokémon**
- **Método:** GET  
- **Rota:** /api/pokemon/list  
- **Header:** Authorization Bearer {{$token}}

**Retornos**:
1. **Sucesso**:
   
json
   [
       {
           "id": 1,
           "name": {"english": "Bulbasaur", "jp": "フシギダネ"},
           "type": ["Grass", "Poison"],
           "base": {"HP": 45, "Attack": 49, "Defense": 49},
           "species": "Seed Pokémon",
           "description": "Bulbasaur can be seen napping in bright sunlight.",
           "evolution": [{"level": 1, "name": "Bulbasaur"}, {"level": 2, "name": "Ivysaur"}],
           "profile": {"height": "0.7m", "weight": "6.9kg"},
           "image": {"hires": "bulbasaur-front.png"}
       },
       {
           "id": 2,
           "name": {"english": "Charmander", "jp": "ヒトカゲ"},
           ...
       }
   ]

2. **Erro - Token inválido**:
   
json
   {
       "message": "Treinador, este token não é mais válido"
   }


---

### **Considerações Finais**
A API Pokémon foi criada para treinar habilidades práticas em desenvolvimento de APIs RESTful e gerenciamento de dados. 🚀
