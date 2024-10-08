# Projeto Laravel

Este é um projeto desenvolvido em Laravel/Lumen, configurado com Docker.

## Pré-requisitos

Certifique-se de ter os seguintes softwares instalados:

- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)

## Instalação

1. **Clone o repositório:**

   ```bash
   git clone https://github.com/gilbertodourado/comerc.git ./comercTeste
   cd comercTeste
   ```

2. **Crie um arquivo .env:**

    Você pode usar o arquivo .env.example como base. Copie-o para criar seu arquivo .env:
    ```bash
    cp ./api/.env.example ./api/.env
    ```
3. **Construa e inicie os containers Docker:**
    ```bash
    docker-compose up -d --build
    ```
4. **Construa e inicie os containers Docker:**
    ```bash
    docker-compose exec php composer install
    ```
5. **Gere a chave de aplicativo:**
    O Lumen não possui um comando automático para gerar a chave APP_KEY. Você pode gerar uma chave manualmente utilizando o seguinte comando:
    ```bash
    docker-compose exec php php -r "echo bin2hex(random_bytes(32)) . PHP_EOL;"
    ```
    Depois de gerar a chave, adicione-a ao seu arquivo .env:
    ```bash
    APP_KEY=base64:SuaChaveAqui
    ```
6. **xecute as migrações do banco de dados:**
    ```bash
    docker-compose exec php php artisan migrate
    ```


# Acesso à aplicação
A aplicação estará disponível em http://192.168.1.14 ou http://localhost no seu navegador.

# Comandos úteis
* Parar os containers:
```bash
docker-compose down
```
* Verificar logs:
```bash
docker-compose logs
```