## **Project Description: Pokemon API - Sao Paulo Skills 2024**

The **Pokemon API - Sao Paulo Skills 2024** is a project developed as part of a practical simulation for the São Paulo Skills 2024 competition. It aims to create and manipulate a RESTful API to manage trainer and Pokémon data. The goal is to simulate a registration and query system inspired by the Pokémon universe, promoting the development of programming and logic skills.

---

### **Competition Context**

**Sao Paulo Skills** is a competition that challenges young professionals to demonstrate their technical skills in various areas, including programming. This project simulates real-world scenarios, allowing participants to test their API development skills.

---

### **Technologies Used**
- **PHP**  
- **MySQL**  
- **Laravel**  
- **Postman**  
- **Composer**  
- **Visual Studio Code**  
- **XAMPP**  
- **MySQL Workbench**

---

### **Installation and Setup**

#### **Prerequisites**
- PHP 7.4 or higher.  
- MySQL installed.  
- Composer.  

#### **Step-by-Step**
1. **Clone the Repository**:
   ```bash
   git clone https://github.com/EltonRuan/apipokemon/
   ```

2. **Install Dependencies**:
   ```bash
   composer install
   ```

3. **Configure the .env File**:
   Update the database credentials in the `.env` file:
   ```plaintext
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=apipokemon
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Run the Migrations**:
   ```bash
   php artisan migrate
   ```

5. **Start the Server**:
   ```bash
   php artisan serve
   ```

---

### **Routes and Responses**

#### **1. Trainer Registration**
- **Method:** POST  
- **Route:** `/api/signup`
  
**Payload**:
```json
{
    "name": "Elton",
    "lastname": "Santos",
    "birthdate": "2023-10-14",
    "city": "city1",
    "username": "EltonRuan",
    "password": "pass12345"
}
```

**Responses**:
1. **Success**:
   ```json
   {
       "message": "Treinador, você foi registrado com sucesso na sua Pokédex"
   }
   ```

2. **Error - User already registered**:
   ```json
   {
       "message": "Não foi possível realizar seu cadastro na Pokédex devido ao seu cadastro já existir, prossiga para o login na sua Pokédex"
   }
   ```

3. **Error - Missing data**:
   ```json
   {
       "message": "Não foi possível realizar seu cadastro na Pokédex devido a informações faltando ou conflitantes"
   }
   ```

---

#### **2. Trainer Login**
- **Method:** POST  
- **Route:** `/api/signin`
  
**Payload**:
```json
{
    "username": "EltonRuan",
    "password": "pass12345"
}
```

**Responses**:
1. **Success**:
   ```json
   {
       "token": "5PMhamPSxmxOO3B0affSyTAN1xtZHM2adgcoFpRgjUII1QeC6GqlArSFrbqS"
   }
   ```

2. **Error - Missing data**:
   ```json
   {
       "message": "Treinador, faltam dados para autenticar você na sua Pokédex"
   }
   ```

3. **Error - Incorrect data**:
   ```json
   {
       "message": "Treinador, parece que seus dados estão incorretos, confira e tente novamente"
   }
   ```

---

#### **3. Trainer Logout**
- **Method:** GET  
- **Route:** `/api/logout`  
- **Header:** Authorization Bearer `{{$token}}`

**Responses**:
1. **Success**:
   ```json
   {
       "message": "Você saiu da sua Pokédex com sucesso"
   }
   ```

2. **Error - Invalid token**:
   ```json
   {
       "message": "Treinador, este token não é mais válido"
   }
   ```

3. **Missing token**:
   ```json
   {
       "message": "Treinador, faltou informar seu token"
   }
   ```

---

#### **4. Trainer Data**
- **Method:** GET  
- **Route:** `/api/trainer/data`  
- **Header:** Authorization Bearer `{{$token}}`

**Responses**:
1. **Success**:
   ```json
   {
       "name": "Elton",
       "lastname": "Santos",
       "birthdate": "2023-10-14",
       "city": "city1",
       "username": "EltonRuan"
   }
   ```

2. **Error - Invalid token**:
   ```json
   {
       "message": "Treinador, este token não é mais válido"
   }
   ```

3. **Missing token**:
   ```json
   {
       "message": "Treinador, faltou informar seu token"
   }
   ```

---

#### **5. Create or Edit Pokémon**
- **Method:** POST  
- **Route:** `/api/pokemon/read`  
- **Header:** Authorization Bearer `{{$token}}`

**Payload**:
- **Create**:
   ```json
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
   ```
- **Edit**:
   ```json
   {
       "id": 2,
       "name": {"english": "Pikachu", "jp": "ピカチュウ"},
       ...
   }
   ```

**Responses**:
1. **Success - Pokémon Created**:
   ```json
   {
       "message": "Pokémon adicionado com sucesso!"
   }
   ```

2. **Success - Pokémon Updated**:
   ```json
   {
       "message": "Pokémon atualizado com sucesso!"
   }
   ```

3. **Error - Missing token**:
   ```json
   {
       "message": "Treinador, faltou informar seu token"
   }
   ```

4. **Error - Invalid token**:
   ```json
   {
       "message": "Treinador, este token não é mais válido"
   }
   ```

---

#### **6. Pokémon List**
- **Method:** GET  
- **Route:** `/api/pokemon/list`  
- **Header:** Authorization Bearer `{{$token}}`

**Responses**:
1. **Success**:
   ```json
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
   ```

2. **Error - Missing token**:
   ```json
   {
       "message": "Treinador, faltou informar seu token"
   }
   ```

3. **Error - Invalid token**:
   ```json
   {
       "message": "Treinador, este token não é mais válido"
   }
   ```

---

#### **7. Pokémon Search**
- **Method:** POST  
- **Route:** `/api/pokemon/view`  
- **Header:** Authorization Bearer `{{$token}}`

**Payload**:
```json
{
    "id": 7
}
```

**Responses**:
1. **Success**:
   ```json
   {
       "id": 7,
       "name": {
           "english": "Pikachu",
           "jp": "ピカチュウ"
       },
       "type": ["Electric"],
       "base": {
           "HP": 35,
           "Attack": 55,
           "Defense": 40
       },
       "species": "Mouse Pokémon",
       "description": "Pikachu that can generate powerful electricity.",
       "evolution": [
           {"level": 1, "name": "Pichu"},
           {"level": 2, "name": "Pikachu"}
       ],
       "profile": {"height": "0.4m", "weight": "6.0kg"},
       "image": {"hires": "pikachu-front.png"}
   }
   ```

2. **Error - Pokémon not found**:
   ```json
   {
       "message": "Pokémon não encontrado!"
   }
   ```

3. **Error - Invalid token**:
   ```json
   {
       "message": "Treinador, este token não é mais válido"
   }
   ```

---

### **Final Considerations**
The Pokémon API was created to train practical skills in RESTful API development and data management. 🚀

---
