<x-guest-layout>
    <div class="max-w-lg mx-auto w-full">
        
        <h2 class="text-2xl font-bold mb-6">Сообщение</h2>
        
        <div class="bg-gray-50 border border-gray-100 rounded-lg p-6 mb-6">
            <p class="text-gray-900 whitespace-pre-wrap leading-relaxed">{{ $decryptedContent }}</p>
        </div>
        
        @if($wasDestroyed)
            <div class="flex items-center gap-2 text-sm text-red-500 mb-8">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                <span>Сообщение удалено. Это был последний просмотр.</span>
            </div>
        @else
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-8">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>Ссылка всё ещё активна. Осталось открытий: {{ $remainingViews ?? 'несколько' }}.</span>
            </div>
        @endif
        
        <a href="{{ route('home') }}" class="text-sm text-gray-400 hover:text-gray-600 transition">
            ← На главную
        </a>
    </div>
</x-guest-layout>