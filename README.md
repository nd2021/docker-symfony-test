# docker-symfony-test

Для запуска проекта понадобится Docker.

## Запустить проект.

1. Клонируем реппо:
`git clone git@github.com:nd2021/docker-symfony-test.git`

2. Переходим в развернутую дирректорию:
`cd docker-symfony-test`

3. Собираем контейнеры и запускаем
`docker-compose up -d --build`

4. Переходим в основной контейнер с приложением
`docker exec -it s_php sh`

5. Собираем Symfony приложение
`composer install`. При запросе разрешения на миграцию в БД нажимаем `Enter [yes]`

6. Если всё прошло успешно, то админка доступна по адресу http://localhost/admin/
