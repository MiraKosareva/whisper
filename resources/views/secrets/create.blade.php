<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 text-center">
        {{ __('Отправьте секретное сообщение. Ссылка на него будет доступна только один раз.') }}
    </div>

    <form method="POST" action="{{ route('secrets.store') }}">
        @csrf
        <div>
            <x-input-label for="content" :value="__('Секретное сообщение')" />
            <textarea 
                id="content" 
                name="content" 
                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                rows="4"
                required
                autofocus
            >{{ old('content') }}</textarea>
            <x-input-error :messages="$errors->get('content')" class="mt-2" />
        </div>

        <div class="flex items-center justify-center mt-4">
            <x-primary-button>
                {{ __('Создать секретную ссылку') }}
            </x-primary-button>
        </div>
    </form>

    <div class="flex justify-center mt-6">
        <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:text-gray-900">
            ← {{ __('На главную') }}
        </a>
    </div>
</x-guest-layout>