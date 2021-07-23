## Установка

1. ```git clone git@github.com:edwardkv/sutochno_test.git```

2. Создаем базу данных

3. копируем файл .env.example в .env.example
```sh 
copy .env.example в .env
```

4. В папке с приложением установим composer
```sh
composer install
```

Сгенерируем ключ
```sh
php artisan key:generate
```

Поменять права на папку storage
```sh
chmod -R 777 storage
```

5. Прописываем параметры БД в .env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sutochno2
DB_USERNAME=user
DB_PASSWORD=user_pass
```


6. Запустить миграции
```sh

php artisan migrate
```

7. При настройке web сервера DocumentRoot должен вести в папку public приложения

Например
```DocumentRoot /home/edward/dev/sites/sutochno2/public```


## Описание

Приложение создано на laravel 8.51
Использован ```bootstrap``` для верстки, ```air datepicker``` для выбора дат.

Таблицы

```discount``` - скидки

```price_base``` - базовая цена 

```price_season``` - сезонные цены

```orders``` - лог расчета(даты заезда, выезда, число человек, стоимость)


