# Laravue To-do List

Projeto de uma Single Page Application (SPA) de um gerenciador de tarefas, onde você pode criar sua conta para poder cadastrar, editar, visualizar e excluír novas tarefas, desenvolvida utilizando VueJS como framework Frontend e Laravel como API REST.

<image src="public/example.gif"></image>

## Primeiros Passos
### Instalação:
Após clonar o repositório, é necessário instalar as dependências do Composer e do Node. Para isso, rodar os comandos:
    
    composer install

e

    npm install

### Configuração

Após a instalação das dependências, é necessário fazer a configuração do arquivo .env. Para isso, copiar o arquivo .env.example e colá-lo no mesmo diretório com o nome de .env, dessa forma:

    ├── .env 
    └── .env.example

Dentro do arquivo .env, informar as credenciais de acesso ao banco de dados que vai ser utilizado:


    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=

Após informar as credenciais de acesso do banco de dados, gerar a app key do projeto utilizando o comando:

    php artisan key:generate

### Migrations:

Agora, com as dependências do composer instaladas e as credenciais de acesso ao banco de dados configuradas, devemos rodas as migrations para a criação das tabelas de usuário e tarefas. Podemos realizar isso executando o comando:

    php artisan migrate

### Inicialização do projeto:

Após todas as configurações de banco de dados e app key, podemos inicializar o projeto, começando pela incialização do servidor, com o comando:

    php artisan serve

E, depois, compilar os arquivos para o front-end utilizando o comando:
    
    npm run dev

Pronto, você já pode começar a testar a aplicação! :)