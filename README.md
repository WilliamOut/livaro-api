# 📚 LivaroAPI - Sistema de Gerenciamento de Biblioteca  

Este projeto é uma **API RESTful** para gerenciamento de biblioteca desenvolvida com **Symfony 7** e **API Platform**.  

---

## 🚀 Tecnologias Utilizadas  
- PHP 8.2+  
- Symfony 7  
- API Platform 3  
- Doctrine ORM  
- SQLite (para desenvolvimento)  
- Composer  

---

## 📋 Funcionalidades  
- ✅ CRUD completo de Autores  
- ✅ CRUD completo de Livros  
- ✅ CRUD completo de Usuários  
- ✅ CRUD completo de Empréstimos  
- ✅ Relacionamentos entre entidades  
- ✅ API REST automática com documentação  
- ✅ Sistema de migrations para versionamento do banco  

---

## 🏗️ Estrutura do Projeto  

livaroapi/
├── src/
│ ├── Entity/ # Entidades Doctrine
│ │ ├── Autor.php
│ │ ├── Livro.php
│ │ ├── Usuario.php
│ │ └── Emprestimo.php
│ ├── Repository/ # Repositórios das entidades
│ └── Controller/ # Controladores (se necessário)
├── config/
│ ├── packages/
│ │ ├── doctrine.yaml # Configuração do Doctrine
│ │ └── api_platform.yaml # Configuração da API
│ └── routes/
├── migrations/ # Arquivos de migration
├── var/
│ └── livaro.db # Banco de dados SQLite
├── public/
│ └── index.php # Entry point da aplicação
├── vendor/ # Dependências do Composer
├── .env # Variáveis de ambiente
├── composer.json
└── composer.lock


---

## 📊 Modelo de Dados  

**Relacionamentos:**  
- Autor (1) ←→ (N) Livro  
- Livro (1) ←→ (N) Empréstimo  
- Empréstimo (N) ←→ (1) Usuário  

### Estrutura das Tabelas  

**Autor**  
- id (INT, PK, Auto Increment)  
- nome (VARCHAR(200))  

**Livro**  
- id (INT, PK, Auto Increment)  
- nome (VARCHAR(200))  
- autor_id (INT, FK para Autor)  

**Usuário**  
- id (INT, PK, Auto Increment)  
- nome (VARCHAR(200))  
- email (VARCHAR(200))  
- senha (VARCHAR(100))  

**Empréstimo**  
- id (INT, PK, Auto Increment)  
- usuario_id (INT, FK para Usuário)  
- livro_id (INT, FK para Livro)  
- diainicio (INT)  
- mesinicio (INT)  
- anoinicio (INT)  
- diafinal (INT)  
- mesfinal (INT)  
- anofinal (INT)  
- stsentregue (BOOLEAN)  

---

## 🛠️ Instalação e Configuração  

### Pré-requisitos  
- PHP 8.2+  
- Composer  
- Git  

### 1. Clonar e Configurar o Projeto  

```bash
git clone [url-do-repositorio]
cd livaroapi
composer install
cp .env .env.local
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:schema:validate
php -S localhost:8000 -t public
```

### 🔄 Fluxo de Sincronização do Banco de Dados
#### quando baixar atualizações do repositório
```bash
# 1. Baixar as mudanças
git pull origin main

# 2. Atualizar dependências (se houver mudanças no composer.json)
composer install

# 3. VERIFICAR SE HÁ NOVAS MIGRATIONS
php bin/console doctrine:migrations:status

# 4. EXECUTAR NOVAS MIGRATIONS
php bin/console doctrine:migrations:migrate

# 5. Verificar se está sincronizado
php bin/console doctrine:schema:validate
```
### Quandor for criar uma nova entidade ou modificar uma existente
#### 1. Fazer suas alterações no código
#### 2. GERAR NOVA MIGRATION
php bin/console make:migration

#### 3. EXECUTAR A MIGRATION LOCALMENTE
php bin/console doctrine:migrations:migrate

#### 4. Commitar a migration junto com o código
git add src/Entity/NovaEntidade.php
git add migrations/Version20240925120000.php
git commit -m "Adiciona nova entidade X"
git push origin main

### 2. Configurar o Banco de Dados

php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:schema:validate

### 3. Popular com Dados de Teste (Opcional)

Via API ou criando fixtures

## 📖 Comandos Doctrine Úteis
### Criar banco de dados
php bin/console doctrine:database:create

### Deletar banco de dados
php bin/console doctrine:database:drop --force

### Ver status das migrations
php bin/console doctrine:migrations:status

### Gerar nova migration
php bin/console make:migration

### Executar migrations
php bin/console doctrine:migrations:migrate

### Reverter última migration
php bin/console doctrine:migrations:migrate prev

### Validar esquema do banco
php bin/console doctrine:schema:validate

## 🔄 Sistema de Migrations
php bin/console make:migration
php bin/console doctrine:migrations:diff --dry-run
php bin/console doctrine:migrations:migrate
php bin/console doctrine:schema:validate

## 💾 Backup do Banco de Dados
## Backup
cp var/livaro.db var/backup_$(date +%Y%m%d_%H%M%S).db
php bin/console doctrine:query:sql ".dump" > backup_$(date +%Y%m%d_%H%M%S).sql

## Restauração
cp var/backup_20240925_120000.db var/livaro.db
php bin/console doctrine:query:sql < backup_file.sql

## 🌐 API Endpoints
Base URL: http://localhost:8000/api
| Método | Endpoint          | Descrição       |
| ------ | ----------------- | --------------- |
| GET    | /api/autores      | Listar autores  |
| POST   | /api/autores      | Criar autor     |
| GET    | /api/autores/{id} | Buscar autor    |
| PUT    | /api/autores/{id} | Atualizar autor |
| DELETE | /api/autores/{id} | Deletar autor   |

Disponível também para: /api/livros, /api/usuarios, /api/emprestimos

Documentação:

Swagger UI: http://localhost:8000/api

## 🚀 Executando a Aplicação
### Desenvolvimento
php -S localhost:8000 -t public
### Acessar em http://localhost:8000/api
## 🧪 Testando a API
### Listar autores
curl http://localhost:8000/api/autores

### Criar autor
curl -X POST http://localhost:8000/api/autores \
  -H "Content-Type: application/json" \
  -d '{"nome": "Autor Teste"}'

### Buscar autor específico
curl http://localhost:8000/api/autores/1

### Atualizar autor
curl -X PUT http://localhost:8000/api/autores/1 \
  -H "Content-Type: application/json" \
  -d '{"nome": "Nome Atualizado"}'

### Deletar autor
curl -X DELETE http://localhost:8000/api/autores/1

# Fluxo completo: criar autor → livro → usuário → empréstimo.

## 🔧 Solução de Problemas
### Migration não gera arquivo
php bin/console cache:clear
composer dump-autoload

### Entidade não reconhecida
php bin/console doctrine:mapping:info
php bin/console cache:clear

### Debug
tail -f var/log/dev.log
php bin/console debug:config doctrine
php bin/console debug:router

# 📄 Licença

Desenvolvido por William Araújo Gonçalves da Silva
