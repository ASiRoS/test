Тестовое задание.

Для запуска потребуются: php >= 7.4, node >= 12.16

Команды, которые нужно запустить:

1) npm install
2) composer install
1) npm run dev

Далее нужно будет запустить сервер:
1) php artisan serve

Далее можно будет увидеть результат работы.

Основные файлы работы находятся в папке: app\Message, app\Controllers

Чтобы сменить хранилище с файлового на базу данных, нужно будет заменить класс с
MessageFileRepository на MessageDatabaseRepository в файле bootstrap/app.php на строке 50.
