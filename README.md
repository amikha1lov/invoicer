
####  Пример запроса на регистрацию

- Адрес: /api/v1/auth/register
- Метод: **POST**

```json
{
    "email": "test@yandex.ru",
    "password": "123456"
}
```

Возвращается токен типа Bearer


####  Пример запроса на авторизацию -

- Адрес: /api/v1/auth/login
- Метод: **POST**

```json
{
    "email": "test@yandex.ru",
    "password": "123456"
}
```
Возвращается токен типа Bearer


####  Пример запроса на создание счета

- Адрес: /api/v1/invoice
- Метод: **POST**

```json
{
  "number": "2680",
  "bank": {
    "name": "Тестовое название банка",
    "bik": "123456789",
    "inn": "1234567890",
    "kpp": "123456789",
    "accountNumber": "12345678901234567890"
  },
  "client": {
    "name": "ИП Сергеев Петр Иванович",
    "address": "город Москва"
  },
  "supplier": {
    "name": "ООО 'Восход'",
    "address": "город Иваново"
  },
  "items": [
    {
      "name": "Поднятие на этаж",
      "quantity": 1,
      "price": 300
    },
    {
      "name": "Доставка",
      "quantity": 1,
      "price": 500
    },
    {
      "name": "Полки",
      "quantity": 3,
      "price": 5000
    }
  ]
}
```
Возвращается id счета
