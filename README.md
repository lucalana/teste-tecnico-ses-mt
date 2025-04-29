# Lista de Tarefas

Projeto de uma simples lista de tarefas, onde o usuário cria sua conta e cria tarefas cada usuário 
só pode ver apenas a sua própria tarefas e editar deletar ou concluir.

## 📌 Tecnologias Usadas

Esse projeto foi desenvolvido com as seguintes tecnologias:

-   [Laravel](https://laravel.com/)
-   [PHP](https://www.php.net/)
-   [Sqlite](https://www.sqlite.org/)
-   [Bootstrap](https://getbootstrap.com/docs/5.3/getting-started/introduction/)


## 🚀 Instalação e configuração

### Pré-requisitos

Para garantir que tudo funcione corretamente siga as instruções de instalação que estão na documentação:

-   [Instalar PHP e Laravel](https://laravel.com/docs/12.x/installation#installing-php)

### Etapas de Instalação

1. **Clone o repositório**

    ```sh
    git clone https://github.com/lucalana/teste-tecnico-ses-mt.git
    cd teste-tecnico-ses-mt
    ```

2. **Instalar dependências**

    ```sh
    composer install
    ```

3. **Crie e configure o arquivo .env**

    ```sh
    cp .env.example .env
    ```

4. **Gere a chave da aplicação**

    ```sh
    php artisan key:generate
    ```

## 🛠 Uso

-   Execute as migrations e seeds
    ```sh
    php artisan migrate:fresh --seed
    ```

-   Logar

    Use o usuário que vai ser criado na migration para logar.
    
        Email: test@gmail.com

        Senha: password

- Na Aplicação 

    - Dentro da aplicação é possível filtrar as tarefas entre todas, pendentes e concluídas
    - É possível alterar uma tarefa de pendente para concluída, clicando no status ao lado do título da tarefa
    - É possível editar uma tarefa, deletar e criar

## 🧪 Teste

-   Para rodar todos os testes execute o comando 
    ```sh
    php artisan test
    ```
