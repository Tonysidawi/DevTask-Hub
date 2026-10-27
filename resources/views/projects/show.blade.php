@extends('layouts.project')

@section('title', $project->name.' - DevTask Hub')

@section('content')
    <div class="container mx-auto max-w-4xl p-8">
        <a href="/projects" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Back to Projects</a>

        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md p-8">
            <div class="flex justify-between items-start">
                <div>
                    <span class="text-xs font-semibold uppercase tracking-wider text-gray-500 bg-gray-100 px-2 py-1 rounded">
                        {{ $project->organisation->name }}
                    </span>
                    <h1 class="text-3xl font-bold text-gray-900 mt-2">{{ $project->name }}</h1>
                    <a href="/projects/{{ $project->id }}/edit" class="text-sm text-blue-600 hover:underline">Edit project</a>
                </div>
                <span class="px-3 py-1 text-sm rounded font-semibold {{ $project->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-200 text-gray-800' }}">
                    {{ ucfirst($project->status) }}
                </span>
            </div>

            <p class="text-gray-700 mt-4 leading-relaxed">{{ $project->description }}</p>

            <hr class="my-6">

            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-800">Project Tasks ({{ $project->tasks->count() }})</h2>
                <a href="/projects/{{ $project->id }}/tasks/create" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 font-semibold text-sm">
                    + Add Task
                </a>
            </div>

            <div class="space-y-3">
                @forelse ($project->tasks as $task)
                    <div class="bg-gray-50 p-4 rounded-lg border flex justify-between items-center">
                        <div>
                            <h3 class="font-semibold text-gray-800">{{ $task->title }}</h3>
                            <p class="text-sm text-gray-600 mt-1">{{ $task->description }}</p>
                            <div class="flex gap-2 mt-2 items-center">
                                <span class="text-xs font-medium text-gray-500">Priority: <span class="uppercase text-gray-700 font-bold">{{ $task->priority }}</span></span>
                                @foreach ($task->tags as $tag)
                                    <span class="text-xs px-2 py-0.5 rounded text-white" style="background-color: {{ $tag->color }};">
                                        {{ $tag->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        <span class="text-xs px-3 py-1 rounded-full font-semibold
                            {{ $task->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                        </span>
                    </div>
                @empty
                    <p class="text-gray-500 italic">No tasks found for this project.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
