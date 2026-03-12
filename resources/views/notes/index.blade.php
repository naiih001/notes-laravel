@extends('layouts.app')

@section('title', 'Notes')

@section('content')
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
                </div>
            </div>
        @empty
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg mb-4">No notes yet</p>
                <a href="{{ route('notes.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition inline-block">
                    Create your first note
                </a>
            </div>
        @endforelse
    </div>
@endsection