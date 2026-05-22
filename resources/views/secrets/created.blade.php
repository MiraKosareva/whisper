<x-guest-layout>
    <div class="mb-4 text-lg font-medium text-gray-900 text-center">
        {{ __('Секрет создан!') }}
    </div>

    <div class="mb-4 text-sm text-gray-600 text-center">
        {{ __('Скопируйте ссылку ниже. Она исчезнет после первого открытия.') }}
    </div>

    <div class="mt-4 flex items-center">
        <input 
            type="text" 
            id="secret-url" 
            value="{{ $url }}" 
            readonly 
            class="block w-full rounded-l-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
        >
        <button 
            type="button" 
            onclick="copyUrl()"
            class="rounded-r-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
        >
            {{ __('Копировать') }}
        </button>
    </div>

    <script>
        function copyUrl() {
            const input = document.getElementById('secret-url');
            input.select();
            document.execCommand('copy');
            
            const button = event.target;
            button.textContent = 'Скопировано!';
            setTimeout(() => {
                button.textContent = 'Копировать';
            }, 2000);
        }
    </script>

    <div class="flex justify-between items-center mt-6">
        <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:text-gray-900">
            ← {{ __('На главную') }}
        </a>
        <a href="{{ route('secrets.create') }}" class="text-sm text-indigo-600 hover:text-indigo-500">
            {{ __('Создать ещё секрет') }} →
        </a>
    </div>
</x-guest-layout>