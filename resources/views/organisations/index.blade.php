@extends('layouts.project')

@section('title', 'Your Organisation - DevTask Hub')

@section('content')
    <div class="container mx-auto p-8">
        @if (! $organisation)
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Your organisation</h1>
            <p class="text-gray-600">Your account is not part of an organisation yet.</p>
        @else
            <div class="mb-6">
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Organisation</p>
                <h1 class="text-3xl font-bold text-gray-800 mt-1">{{ $organisation->name }}</h1>
                <p class="text-gray-600 mt-2">Projects in this organisation.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse ($organisation->projects as $project)
                    <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-blue-500">
                        <div class="flex justify-between items-start gap-4">
                            <h2 class="text-xl font-bold text-gray-900">
                                <a href="/projects/{{ $project->id }}" class="hover:text-blue-600 transition-colors">
                                    {{ $project->name }}
                                </a>
                            </h2>
                            <span class="px-3 py-1 text-xs rounded font-semibold {{ $project->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-200 text-gray-800' }}">
                                {{ ucfirst($project->status) }}
                            </span>
                        </div>

                        <p class="text-gray-600 text-sm mt-2">{{ $project->description }}</p>
                        <p class="text-sm text-gray-500 mt-4">{{ $project->tasks_count }} {{ $project->tasks_count === 1 ? 'task' : 'tasks' }}</p>
                    </div>
                @empty
                    <p class="text-gray-600">This organisation has no projects yet.</p>
                @endforelse
            </div>
        @endif
    </div>
@endsection
