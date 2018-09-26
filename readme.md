## ФИНАЛЬНОЕ ЗАДАНИЕ

Финальное задание с отложенными переводами средств между 
пользователями.

<b>Для того, чтобы развернуть проект необходимо выполнить следующие действия:</b>

1. Установить Docker и Docker-Compose.

2. Клонировать проект в папку у себя на локальной машине.
    ```
    git clone https://github.com/Kalagur/FinalEx.git
    ```
3. В терминале перейти в папку с проектом.

4. Установить composer
    ```
    docker run --rm -v $(pwd):/app composer/composer install
    ```   
5. Собрать проект
    ```
    docker-compose up -d --build
    ```    
6. Клонировать файл конфига проекта 
    ```
    cp example.env .env
    ```   
7. Сгенерировать ключ
    ```
    docker-compose exec app php artisan key:generate
    ```       
8.  Выполнить команду
    ```
    docker-compose exec app php artisan optimize
    ```   
9. Выдать права на нужные директории
    ```
    sudo chmod -R 777 storage && sudo chmod -R 777 bootstrap/cache
    ```    
10. Накатить миграции и сиды (создание таблиц в БД и заполнение тестовыми данными)
    ```
    docker-compose exec app php artisan migrate --seed
    ``` 
11. Для работы отложенных переводов выполнить команду
    ```
    crontab -e
    ```  
12. В конец файла добавить данную строку
    ```
    * * * * * docker exec finalex_app_1 php artisan schedule:run >> /dev/null 2>&1
    ```    
    
Сайт доступен по адресу: http://localhost:8080/    
      
          


