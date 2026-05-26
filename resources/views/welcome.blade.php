<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Whisper — самоуничтожающиеся сообщения</title>
     <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased bg-white text-gray-900">
    <div class="min-h-screen flex flex-col">
        
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

        <main class="flex-1 flex items-center justify-center px-6">
            <div class="max-w-2xl w-full text-center py-20">
   
                <span class="inline-block px-3 py-1 text-xs font-medium text-indigo-600 bg-indigo-50 rounded-full mb-6">
                    одноразовые сообщения
                </span>
                
                <h1 class="text-5xl font-bold tracking-tight mb-6">
                    Скажи и исчезни
                </h1>
               
                <div class="flex justify-center mb-8">
                    <div class="w-16 h-0.5 bg-indigo-600 animate-pulse"></div>
                </div>
                
                <p class="text-lg text-gray-500 mb-10 max-w-md mx-auto leading-relaxed">
                    Отправьте сообщение, которое будет прочитано только один раз 
                    и навсегда исчезнет.
                </p>
                
                <a href="{{ route('secrets.create') }}" 
                   class="inline-block px-8 py-3 bg-gray-900 text-white text-sm font-medium rounded-lg hover:bg-gray-800 transition">
                    Создать секрет
                </a>
                
                <div class="grid grid-cols-3 gap-8 mt-20 text-left">
                    <div>
                        <div class="text-2xl mb-3 text-gray-300">01</div>
                        <h3 class="font-semibold mb-2">Напишите</h3>
                        <p class="text-sm text-gray-500">Текст вашего сообщения</p>
                    </div>
                    <div>
                        <div class="text-2xl mb-3 text-gray-300">02</div>
                        <h3 class="font-semibold mb-2">Отправьте</h3>
                        <p class="text-sm text-gray-500">Ссылку получателю</p>
                    </div>
                    <div>
                        <div class="text-2xl mb-3 text-gray-300">03</div>
                        <h3 class="font-semibold mb-2">Забудьте</h3>
                        <p class="text-sm text-gray-500">Сообщение удалится</p>
                    </div>
                </div>
            </div>
        </main>
      
        <footer class="border-t border-gray-100 py-6 text-center text-xs text-gray-400">
            whisper &middot; секреты в безопасности
        </footer>
    </div>
</body>
</html>