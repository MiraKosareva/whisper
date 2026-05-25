<x-guest-layout>
    <div class="max-w-lg mx-auto w-full">
        
        <h2 class="text-2xl font-bold mb-2">Новое сообщение</h2>
        <p class="text-gray-500 text-sm mb-8">
            После создания вы получите ссылку. Отправьте её тому, кто должен прочитать сообщение.
        </p>

        <form method="POST" action="{{ route('secrets.store') }}">
            @csrf

            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-gray-900 mb-2">
                    Текст сообщения
                </label>
                <textarea 
                    id="content" 
                    name="content" 
                    rows="5"
                    class="block w-full rounded-lg border-gray-200 bg-gray-50 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-indigo-500 placeholder:text-gray-400"
                    placeholder="Напишите то, что должно исчезнуть..."
                    required
                    autofocus
                >{{ old('content') }}</textarea>
                <x-input-error :messages="$errors->get('content')" class="mt-2" />
            </div>

            <div class="mb-6">
                <label for="max_views" class="block text-sm font-medium text-gray-900 mb-2">
                    Количество открытий
                </label>
                <select 
                    id="max_views" 
                    name="max_views" 
                    class="block w-full rounded-lg border-gray-200 bg-gray-50 px-4 py-3 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                >
                    <option value="1">1 раз (самоуничтожение после прочтения)</option>
                    <option value="3">3 раза</option>
                    <option value="5">5 раз</option>
                    <option value="10">10 раз</option>
                </select>
                <x-input-error :messages="$errors->get('max_views')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}" class="text-sm text-gray-400 hover:text-gray-600 transition">
                    ← Назад
                </a>
                <x-primary-button>
                    Создать ссылку
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>