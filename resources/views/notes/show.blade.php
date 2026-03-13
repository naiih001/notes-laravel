<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $note->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">
                    {{ $note->title }}
                </h1>
                
                <p class="text-gray-500 text-sm mb-6">
                    {{ __('Created') }} {{ $note->created_at->diffForHumans() }}
                    @if($note->created_at->ne($note->updated_at))
                        • {{ __('Updated') }} {{ $note->updated_at->diffForHumans() }}
                    @endif
                </p>

                <div class="prose prose-sm max-w-none mb-8 text-gray-700 whitespace-pre-wrap">
                    {{ $note->content }}
                </div>

                <div class="flex gap-3 border-t border-gray-200 pt-6">
                    <a href="{{ route('notes.edit', $note) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition">
                        {{ __('Edit') }}
                    </a>
                    
                    <form method="POST" action="{{ route('notes.destroy', $note) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-6 rounded-lg transition" onclick="return confirm('{{ __('Are you sure you want to delete this note? This action cannot be undone.') }}');">
                            {{ __('Delete') }}
                        </button>
                    </form>

                    <a href="{{ route('notes.index') }}" class="text-gray-600 hover:text-gray-700 font-medium py-2 px-6 border border-gray-300 rounded-lg transition">
                        {{ __('Back') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
