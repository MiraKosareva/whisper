<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Whisper — самоуничтожающиеся сообщения</title>
     <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased bg-white text-gray-900">
    <header class="border-b border-gray-100">
            <div class="max-w-5xl mx-auto px-6 py-4 flex justify-between items-center">
                <a href="/" class="text-xl font-bold tracking-tight">
                    whisper
                </a>
                <nav class="flex gap-6 text-sm">
                    @auth
                        <a href="{{ route('dashboard') }}" class="hover:text-indigo-600 transition">Личный кабинет</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="hover:text-indigo-600 transition">Выйти</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="hover:text-indigo-600 transition">Войти</a>
                        <a href="{{ route('register') }}" class="hover:text-indigo-600 transition">Регистрация</a>
                    @endauth
                </nav>
            </div>
        </header>
<div class="max-w-3xl mx-auto px-6 py-12">

    <h2 class="text-2xl font-bold mb-2">Мои секреты</h2>
    <p class="text-gray-500 text-sm mb-8">
        Секреты, которые вы создали. Они исчезнут после открытия получателем.
    </p>

    @if($secrets->isEmpty())
        <div class="text-center py-12 text-gray-400">
            <p class="mb-4">У вас пока нет секретов.</p>
            <a href="{{ route('secrets.create') }}" 
               class="inline-block px-6 py-2 bg-gray-900 text-white text-sm font-medium rounded-lg hover:bg-gray-800 transition">
                Создать первый
            </a>
        </div>
    @else
        <div class="space-y-3">
            @foreach($secrets as $secret)
                <div class="flex items-center justify-between p-4 bg-gray-50 border border-gray-100 rounded-lg">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm text-gray-900 truncate">
                            {{ Str::limit(Crypt::decrypt($secret->content), 60) }}
                        </p>
                        <p class="text-xs text-gray-400 mt-1">
                            {{ $secret->created_at->format('d.m.Y H:i') }}
                            @if($secret->isExpired())
                                <span class="text-red-400 ml-2">Истёк</span>
                            @else
                                <span class="text-green-500 ml-2">Активен</span>
                            @endif
                        </p>
                    </div>
                    <button 
                        onclick="copyToClipboard('{{ route('secrets.show', $secret->token) }}')"
                        class="text-xs text-gray-400 hover:text-indigo-600 transition ml-4"
                    >
                        Копировать ссылку
                    </button>
                </div>
            @endforeach
        </div>
    @endif
</div>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text);
    }
</script>
</body>
</html>