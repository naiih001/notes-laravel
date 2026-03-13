<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
                <h1 class="text-2xl font-bold text-gray-900 mb-6">{{ __('Edit note') }}</h1>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <p class="text-red-700 font-medium mb-2">{{ __('Please fix the following errors:') }}</p>
                        <ul class="text-red-600 text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('notes.update', $note) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('Title') }}
                        </label>
                        <input 
                            type="text" 
                            id="title" 
                            name="title" 
                            placeholder="{{ __('Enter note title') }}"
                            value="{{ old('title', $note->title) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror"
                            required
                        >
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('Content') }}
                        </label>
                        <textarea 
                            id="content" 
                            name="content" 
                            rows="10"
                            placeholder="{{ __('Write your note here...') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('content') border-red-500 @enderror"
                            required
                        >{{ old('content', $note->content) }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3">
                        <button 
                            type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition"
                        >
                            {{ __('Update Note') }}
                        </button>
                        <a 
                            href="{{ route('notes.index') }}" 
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-6 rounded-lg transition"
                        >
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
