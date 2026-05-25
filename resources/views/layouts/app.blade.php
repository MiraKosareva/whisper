<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Whisper') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased bg-white text-gray-900">
    <div class="min-h-screen flex flex-col">

        <header class="border-b border-gray-100">
            <div class="max-w-5xl mx-auto px-6 py-4 flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-xl font-bold tracking-tight">
                    whisper
                </a>
                <nav class="flex gap-6 text-sm items-center">
                    <a href="{{ route('secrets.create') }}" class="hover:text-indigo-600 transition">Новый секрет</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="hover:text-indigo-600 transition">Выйти</button>
                    </form>
                </nav>
            </div>
        </header>

        <main class="flex-1">
            {{ $slot }}
        </main>
        
        <footer class="border-t border-gray-100 py-6 text-center text-xs text-gray-400">
            whisper &middot; секреты в безопасности
        </footer>
    </div>
</body>
</html>