# User setting update confirmation demo

## Реализовано

- Бекенд - частично, абстрактно
- Фронтенд - нет (в разработке)

## Доступы
- test@example.com
- password

## Запуск проекта
1. Клонировать репозиторий
2. Установить зависимости через Composer, либо через Docker c помощью команды:
```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```
3. Выполнить запуск сервера с помощью команды:
```
./vendor/bin/sail up -d
```
4. Запустить миграции
```
./vendor/bin/sail artisan migrate
```
5. Запустить сидеры
```
./vendor/bin/sail artisan db:seed
```
6. Собрать фронтенд
```
./vendor/bin/sail yarn build
```
6. Приложение будет доступно по следующему адресу:
```
http://localhost:8080
```
## Примеры запросов к API

Login
```
curl --request POST \
  --url http://localhost:8080/api/login \
  --header 'Content-Type: multipart/form-data' \
  --form email=test@example.com \
  --form password=password
```
Logout
```
curl --request POST \
  --url http://localhost:8080/api/logout \
  --header 'Authorization: Bearer <Token>'
```
Settings
```
curl --request GET \
  --url http://localhost:8080/api/settings \
  --header 'Accept: application/json' \
  --header 'Authorization: Bearer <Token>'
```
Update setting with confirmation
```
curl --request POST \
  --url http://localhost:8080/api/settings \
  --header 'Accept: application/json' \
  --header 'Authorization: Bearer <Token>' \
  --header 'Content-Type: multipart/form-data' \
  --form setting_id=3 \
  --form 'value=My profile'
```
Confirm update setting
```
curl --request POST \
  --url http://localhost:8080/api/settings/confirm \
  --header 'Accept: application/json' \
  --header 'Authorization: Bearer <Token>' \
  --header 'Content-Type: multipart/form-data' \
  --form code=<Code>
```
