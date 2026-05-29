# Whisper

Сервис для отправки самоуничтожающихся секретных сообщений.  
Сообщение можно прочитать ограниченное количество раз, после чего оно навсегда удаляется.

## Стек

- **Backend**: Laravel 13.2.0, PHP 8.3.30
- **Frontend**: Tailwind CSS
- **База данных**: MySQL
- **Аутентификация**: Laravel Breeze

## Возможности

- Создание секретных сообщений с шифрованием
- Одноразовые ссылки (или с ограниченным числом открытий: 1, 3, 5, 10)
- Автоудаление по истечении 24 часов
- Автоудаление после исчерпания лимита просмотров
- Регистрация и личный кабинет с историей секретов
- Консольная команда для очистки просроченных секретов

## Безопасность

- Все секреты шифруются перед сохранением в БД (Laravel Crypt)
- После прочтения секрет удаляется из базы
- Просроченные секреты удаляются автоматически

## Установка

```bash
# Клонирование репозитория
git clone https://github.com/MiraKosareva/whisper.git
cd whisper

# Установка зависимостей
composer install

# Настройка окружения
cp .env.example .env
php artisan key:generate

# База данных (создайте БД в phpMyAdmin и укажите в .env)
php artisan migrate --seed

# Запуск
php artisan serve

# Удалить просроченные секреты вручную
php artisan secrets:delete-expired

# Запустить планировщик (для cron)
php artisan schedule:run
```
## Лицензия 
MIT License

Copyright (c) 2026 Mira Kosareva

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
