## ФИНАЛЬНОЕ ЗАДАНИЕ

Финальное задание с отложенными переводами средств между 
пользователями.

<b>Для того, чтобы развернуть проект необходимо выполнить следующие действия:</b>

1. Клонировать проект в папку у себя на локальной машине.
    ```
    git clone https://github.com/Kalagur/FinalEx.git
    ```
2. В терминале перейти в папку с проектом.

3. Установить composer
    ```
    docker run --rm -v $(pwd):/app composer/composer install
    ```
    
4. Собрать проект
    ```
    docker-compose up -d --build
    ```    
5. Клонировать файл конфига проекта 
    ```
    cp example.env .env
    ```   
6. Сгенерировать ключ
    ```
    docker-compose exec app php artisan key:generate
    ```       
7.  Выполнить команду
    ```
    docker-compose exec app php artisan optimize
    ```   
8. Выдать права на нужные директории
    ```
    sudo chmod -R 777 storage && sudo chmod -R 777 bootstrap/cache
    ```    
    
 Сайт доступен на http://localhost:8080/
 
9. Накатить миграции и сиды (создание таблиц в БД и заполнение тестовыми данными)
    ```
    docker-compose exec app php artisan migrate --seed
    ``` 
10. Для работы отложенных переводов выполнить команду
    ```
    crontab -e
    ```  
11. В конец файла добавить данную строку
    ```
    * * * * * docker exec finalex_app_1 php artisan schedule:run >> /dev/null 2>&1
    ```    
      
          


