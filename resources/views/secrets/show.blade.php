<x-guest-layout>
    <div class="mb-4 text-lg font-medium text-gray-900 text-center">
        {{ __('🔓 Секретное сообщение') }}
    </div>

    <div class="p-6 bg-gradient-to-r from-yellow-50 to-amber-50 border-2 border-amber-200 rounded-lg">
        <p class="text-gray-800 whitespace-pre-wrap text-lg">{{ $decryptedContent }}</p>
    </div>

    <div class="p-4 bg-green-50 border border-green-200 rounded-md mt-4">
        <p class="text-sm text-green-700 text-center">
            {{ __('✅ Этот секрет только что был прочитан и навсегда удалён из системы.') }}
        </p>
        <p class="text-xs text-green-600 text-center mt-1">
            {{ __('Ссылка больше не работает. Никто не сможет прочитать это сообщение снова.') }}
        </p>
    </div>

    <div class="flex justify-between items-center mt-6">
        <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:text-gray-900">
            ← {{ __('На главную') }}
        </a>
        <a href="{{ route('secrets.create') }}" class="text-sm text-indigo-600 hover:text-indigo-500">
            {{ __('Создать свой секрет') }} →
        </a>
    </div>
</x-guest-layout>