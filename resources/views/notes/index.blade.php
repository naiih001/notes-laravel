<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My Notes') }}
            </h2>
            <a href="{{ route('notes.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition">
                + {{ __('New Note') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-4">
                @forelse($notes as $note)
                    <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition border border-gray-200 p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">
                            {{ $note->title }}
                        </h2>
                        <p class="text-gray-600 line-clamp-3">
                            {{ Str::limit($note->content, 150) }}
                        </p>
                        <div class="mt-4 flex gap-3">
                            <a href="{{ route('notes.show', $note) }}" class="text-blue-600 hover:text-blue-700 font-medium text-sm">
                                View
                            </a>
                            <a href="{{ route('notes.edit', $note) }}" class="text-blue-600 hover:text-blue-700 font-medium text-sm">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('notes.destroy', $note) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-700 font-medium text-sm" onclick="return confirm('Are you sure you want to delete this note?');">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
                        <p class="text-gray-500 text-lg mb-4">{{ __('No notes yet') }}</p>
                        <a href="{{ route('notes.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition inline-block">
                            {{ __('Create your first note') }}
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
