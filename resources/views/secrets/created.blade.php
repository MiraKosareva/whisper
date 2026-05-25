<x-guest-layout>
    <div class="max-w-lg mx-auto w-full text-center">
        
        <div class="w-12 h-12 bg-gray-900 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        
        <h2 class="text-2xl font-bold mb-2">Ссылка готова</h2>
        <p class="text-gray-500 text-sm mb-8">
            Скопируйте и отправьте получателю. Ссылка сгорит после открытия.
        </p>

        <div class="flex items-center gap-2 mb-8">
            <input 
                type="text" 
                id="secret-url" 
                value="{{ $url }}" 
                readonly 
                class="block w-full rounded-lg border-gray-200 bg-gray-50 px-4 py-2.5 text-sm text-gray-600"
            >
            <button 
                type="button" 
                onclick="copyUrl()"
                class="rounded-lg bg-gray-900 px-4 py-2.5 text-sm font-medium text-white hover:bg-gray-800 transition"
            >
                Копировать
            </button>
        </div>

        <a href="{{ route('secrets.create') }}" class="text-sm text-indigo-600 hover:text-indigo-500 transition">
            Создать ещё один секрет →
        </a>

        <script>
            function copyUrl() {
                const input = document.getElementById('secret-url');
                input.select();
                navigator.clipboard.writeText(input.value);
                const button = event.target;
                const originalText = button.textContent;
                button.textContent = 'Скопировано!';
                setTimeout(() => { button.textContent = originalText; }, 1500);
            }
        </script>
    </div>
</x-guest-layout>