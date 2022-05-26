## О проекте

Данный сайт был разработан для международной цифровой олимпиады «Волга-IT`22».  

## Требования
<ul>
    <li>PHP версии 7.4</li>
    <li>Установленный Git</li>
    <li>Установленный Composer</li>
    <li>Локальный сервер для запуска проекта</li>
</ul>

## Установка
Зайди в папку для установки проекта

    cd namefoled
Клонировать репозиторий

    git clone https://github.com/YouMixx/TeatcherHelper.git .
Произвести установку зависимости пакетов

    composer install
Переименовать .env.example в .env

Сгенерировать ключ 

    php artisan key:generate
Запустить сервер

    php artisan serve