# Тестовое задание для компании Тапиго

## Максимально коротко

### Установка

1. Клон репозитория
2. ```make build```
3. Подождать 10-15 секунд, пока запускается БД
4. ```make setup```

#### Ручная установка:

1. Клон репозитория
2. ```docker-compose up -d```
3. ```docker exec app php artisan migrate```
4. ```docker exec app php artisan db:seed```

### Эндпоинты:

#### Auth:

* POST /api/auth/register
* POST /api/auth/login

#### Posts:

* GET /api/posts
* GET /api/posts/:id

_У эндпоинта получения списка постов есть квери параметр user, он должен принимать значение айдишника пользователя, либо слово "me", если пользователь авторизован и хочет посмотреть свои посты._

Буду благодарен любому фидбеку!