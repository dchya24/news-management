# News Management

## Installation

1. Clone project

    ```bash
    git clone https://github.com/dchya24/news-management.git project-name
    ```

2. Copy .env.example with name .env

    Copy with terminal

    ```bash
    cp .env.example .env
    ```

3. Configure .env file 

4. Install require library or package 

    ```bash
    composer install
    ```

5. Migrate database
  
    ```bash
    php artisan migrate
    ```

6. Setting passport

    ```bash
    php artisan passport:install
    php artisan passport:key
    ```

7. Generate database seed

    Generate admin user

    ```bash
    php artisan db:seed --class=UseerSeeder
    ```

    Generate Dummy Data

    ```bash
    php artisan db:seed
    ```

8. Run Program

## Postman Collection

Postman Collecion for test project click [link](https://www.postman.com/dchya24/workspace/public-work-space/collection/3528718-16768bff-0d15-4b85-a3db-4c0b35800757?action=share&creator=3528718)

