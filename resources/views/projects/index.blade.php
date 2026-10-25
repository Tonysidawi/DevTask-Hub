@extends('layouts.project')

@section('title', 'DevTask Hub - Projects')

@section('content')
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Projects</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($projects as $project)
                <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-blue-500">
                    <span class="text-xs font-semibold uppercase tracking-wider text-gray-500">
                        {{ $project->organization->name }}
                    </span>

                    <h2 class="text-xl font-bold text-gray-900 mt-1">
                        <a href="/projects/{{ $project->id }}" class="hover:text-blue-600 transition-colors">
                            {{ $project->name }}
                        </a>
                    </h2>

                    <p class="text-gray-600 text-sm mt-2 mb-4">{{ $project->description }}</p>

                    <h3 class="font-semibold text-gray-700 border-b pb-1 mb-3">Tasks:</h3>
                    <ul class="space-y-3">
                        @foreach ($project->tasks as $task)
                            <li class="bg-gray-50 p-3 rounded border flex justify-between items-center">
                                <div>
                                    <span class="font-medium text-gray-800">{{ $task->title }}</span>
                                    <div class="flex gap-1 mt-1">
                                        @foreach ($task->tags as $tag)
                                            <span class="text-xs px-2 py-0.5 rounded text-white" style="background-color: {{ $tag->color }};">
                                                {{ $tag->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                                <span class="text-xs px-2 py-1 rounded font-semibold
                                    {{ $task->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
@endsection
