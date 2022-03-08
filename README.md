# Lumen-Docker project

Установка проекта
    
    git clone https://github.com/MrRouOne/docker-lumen

Запуск проекта

    Создайте файл .env в /project и заполните его данными из файла .env.example
    cd docker-lumen/deploy
    docker-compose up -d --build


Устванока зависимостей 

    docker exec app_container composer install

Настройка базы данных

    docker exec app_container php artisan migrate:refresh 
    docker exec app_container php artisan db:seed
    docker exec app_container php artisan jwt:secret

Вход в Adminer

    http://localhost:63/
    System - PostgreSQL
    Server - db
    Username - root
    Password - root
    Database - lumen
    
    




    

    
