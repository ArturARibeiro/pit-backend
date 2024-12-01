# Projeto Integrador Transdisciplinar - Backend

## Pré-requisitos

Certifique-se de ter os seguintes itens instalados:

- PHP (>= 8.2)
- Composer
- MySQL ou MariaDB

## Passos Iniciais

1. **Instale as Dependências do Composer**:
   ```bash
   composer install
   ```

2. **Configure o Arquivo `.env`**:
   Copie o arquivo de exemplo e ajuste as configurações de ambiente.
   ```bash
   cp .env.example .env
   ```

   Atualize as variáveis no arquivo `.env`:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=<nome-do-banco>
   DB_USERNAME=<usuario>
   DB_PASSWORD=<senha>
   
   ALLOWED_ORIGINS=<frontend-url>
   ```

3. **Gere a Chave da Aplicação**:
   ```bash
   php artisan key:generate
   ```

4. **Gere a Chave do Laravel Passport**:
   ```bash
   php artisan passport:keys
   ```

5. **Execute as Migrações e Seeders**:
   ```bash
   php artisan migrate --seed
   ```

6. **Inicie o Servidor Local**:
   ```bash
   php artisan serve
   ```

   O projeto estará acessível em [http://127.0.0.1:8000](http://127.0.0.1:8000).

## Comando para Notificações

  ```bash
  php artisan schedule:work
  ```
