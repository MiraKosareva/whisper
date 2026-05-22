<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Whisper — секретные сообщения</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50">
    <div class="min-h-screen flex flex-col items-center justify-center">
        <!-- Логотип и заголовок -->
        <div class="text-center mb-10">
            <h1 class="text-6xl font-bold text-gray-900 mb-4">
                🤫 Whisper
            </h1>
            <p class="text-xl text-gray-600 max-w-md mx-auto">
                Отправьте секретное сообщение, которое самоуничтожится после прочтения.
            </p>
        </div>

        <!-- Как это работает -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-3xl mb-10">
            <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                <div class="text-3xl mb-3">✍️</div>
                <h3 class="font-semibold text-gray-900 mb-2">1. Напишите</h3>
                <p class="text-sm text-gray-600">Введите текст секретного сообщения</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                <div class="text-3xl mb-3">🔗</div>
                <h3 class="font-semibold text-gray-900 mb-2">2. Отправьте ссылку</h3>
                <p class="text-sm text-gray-600">Поделитесь сгенерированной ссылкой</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                <div class="text-3xl mb-3">💥</div>
                <h3 class="font-semibold text-gray-900 mb-2">3. Самоуничтожение</h3>
                <p class="text-sm text-gray-600">После прочтения секрет исчезнет навсегда</p>
            </div>
        </div>

        <!-- Кнопки действий -->
        <div class="flex gap-4">
            @auth
                <a href="{{ route('dashboard') }}" 
                   class="rounded-md bg-indigo-600 px-6 py-3 text-lg font-semibold text-white shadow-sm hover:bg-indigo-500">
                    В панель управления
                </a>
            @else
                <a href="{{ route('login') }}" 
                   class="rounded-md bg-white px-6 py-3 text-lg font-semibold text-gray-900 shadow-sm ring-1 ring-gray-300 hover:bg-gray-50">
                    Войти
                </a>
                <a href="{{ route('register') }}" 
                   class="rounded-md bg-indigo-600 px-6 py-3 text-lg font-semibold text-white shadow-sm hover:bg-indigo-500">
                    Регистрация
                </a>
            @endauth
        </div>

        <!-- Ссылка на создание секрета (доступна всем) -->
        <div class="mt-8">
            <a href="{{ route('secrets.create') }}" 
               class="text-indigo-600 hover:text-indigo-500 font-semibold text-lg">
                → Создать секретное сообщение
            </a>
        </div>
    </div>
</body>
</html>